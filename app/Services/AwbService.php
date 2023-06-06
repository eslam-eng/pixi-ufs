<?php

namespace App\Services;

use App\DTO\Awb\AwbDTO;
use App\Enums\AwbStatuses;
use App\Enums\ImageTypeEnum;
use App\Exceptions\NotFoundException;
use App\Models\Awb;
use App\Models\CompanyShipmentType;
use App\Models\Receiver;
use App\QueryFilters\AwbFilters;
use App\QueryFilters\AwbsFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;


class AwbService extends BaseService
{

    public $user;

    public function __construct(
        public Awb               $model,
        public ReceiverService   $receiverService,
        public PriceTableService $priceTableService,
        public BranchService     $branchService
    )
    {
    }

    public function getModel(): Awb
    {
        return $this->model;
    }

    /**
     * @throws NotFoundException
     */
    //method for api with pagination
    public function listing(array $filters = [], array $withRelations = [], $perPage = 3): \Illuminate\Contracts\Pagination\CursorPaginator
    {
        return $this->queryGet(filters: $filters, withRelations: $withRelations)->cursorPaginate($perPage);
    }

    public function queryGet(array $filters = [], array $withRelations = []): Builder
    {
        $awbs = $this->model->query()->with($withRelations)->orderBy('id', 'desc');
        return $awbs->filter(new AwbFilters($filters));
    }


    public function store(AwbDTO $awbDTO)
    {

//      get receiver object info
        $receiver = $this->receiverService->findById(id: $awbDTO->receiver_id, withRelations: ['defaultAddress']);

        //get branch address city and area
        $branch = $this->branchService->findById($awbDTO->branch_id);
        //get shipment type & payment type
        $shipment_type = CompanyShipmentType::find($awbDTO->shipment_type);
        if (!$shipment_type)
            throw new NotFoundException(trans('app.shipment_type_not_found'));

        $priceTable = $this->priceTableService->getShipmentPrice(from: $branch->city_id, to: $receiver->defaultAddress->city_id);

        $awbDTO->company_shipment_type = $shipment_type->name;

        $awbDTO->zone_price = $priceTable->price;
        //check on weight if there is additional kg price or not
        $awbDTO->additional_kg_price = 0 ;
        if ($awbDTO->weight > $priceTable->basic_kg)
            $awbDTO->additional_kg_price = ($awbDTO->weight - $priceTable->basic_kg) * $priceTable->additional_kg_price;
        $awbDTO->receiver_data = $receiver->toArray();

        $awb_data = $awbDTO->toArray();

        $awb = $this->model->create($awb_data);
        //store default history
        $awb->history()->create(['user_id' => $awbDTO->user_id, 'awb_status_id' => AwbStatuses::PREPARE->value]);
        //get additional info
        $awb_additional_infos_data = array_filter($awbDTO->awbAdditionalInfos());
        //store additional infos
        if (count($awb_additional_infos_data))
            $awb->additionalInfo()->create($awb_additional_infos_data);
        return $awb;
    }

    public function lastStatus(int $id)
    {
        $awb = $this->findById($id);
        return $awb->latestStatus;
    }

    public function pod(int $id, array $data): bool
    {
        $awb = $this->findById($id);
        $awb->update(Arr::except($data, 'images'));
        if (isset($data['images']) && is_array($data['images']))
            foreach ($data['images'] as $image) {
                $fileData = FileService::saveImage(file: $image, path: 'uploads/awbs', field_name: 'images');
                $fileData['type'] = ImageTypeEnum::CARD;
                $awb->storeAttachment($fileData);
            }
        $data = [
            'user_id'=>$awb->user_id,
            'awb_status_id'=>AwbStatuses::COLLECTED,
        ];
        $awb->history()->create($data);
        return true;
    }

    public function datatable(array $filters = [], array $withRelations = [])
    {
        $awbs = $this->getQuery()->with($withRelations);
        return $awbs->filter(new AwbFilters($filters));
    }


    public function deleteMultiple(array $ids)
    {
        return $this->getQuery()->whereIn('id',$ids)->delete();
    }

    public function delete(int $id)
    {
        return $this->getQuery()->where('id',$id)->delete();
    }

    public function find(int $id, array $relations = [])
    {
        $awb = Awb::with($relations)->find($id);
        if(!$awb)
            throw new NotFoundException(trans('app.not_found'));
        return $awb;
    }
}
