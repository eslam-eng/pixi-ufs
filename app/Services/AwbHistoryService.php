<?php

namespace App\Services;

use App\Enums\AwbStatuses;
use App\Enums\ImageTypeEnum;
use App\Models\Awb;
use App\Models\AwbHistory;
use Exception;
use Illuminate\Support\Arr;

class AwbHistoryService extends BaseService
{

    public function __construct(public AwbHistory $model)
    {
    }

    public function getModel(): AwbHistory
    {
        return $this->model;
    }

    public function changeMultipleAwbStatus(int $status, array $awb_ids = [])
    {
        $inserted_data = [];
        $user_id = auth()->id();
        foreach ($awb_ids as $id) {
            $inserted_data [] = [
                'awb_id' => $id,
                'user_id' => $user_id,
                'awb_status_id' => $status
            ];
        }

        return $this->model->insert($inserted_data);
    }


    public function changeStatus(Awb $awb, array $data = [])
    {
        $status = Arr::get($data, 'status');
        if(!$awb->latestStatus->awb_status_id == AwbStatuses::DELIVERED->value || $status?->code == $awb->latestStatus->awb_status_id)
            throw new Exception('not allowed');
        if (isset($status) && $status?->code == AwbStatuses::DELIVERED->value) {
            $pod_data = [
                'actual_recipient' => Arr::get($data, 'actual_recipient'),
                'title' => Arr::get($data, 'title'),
                'card_number' => Arr::get($data, 'card_number'),
            ];
            $awb->update($pod_data);
        }

        $history = $awb->history()->create($data);
        if ($history && isset($data['images']) && is_array($data['images'])) {
            foreach ($data['images'] as $image) {
                $fileData = FileService::saveImage(file: $image, path: 'uploads/pod/awbs', field_name: 'images');
                $fileData['type'] = ImageTypeEnum::CARD;
                $history->storeAttachment($fileData);
            }
        }

    }

}
