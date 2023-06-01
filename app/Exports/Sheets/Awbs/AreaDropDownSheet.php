<?php

namespace App\Exports\Sheets\Awbs;

use App\Services\LocationsService;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Cell\DataValidation;

class AreaDropDownSheet implements FromCollection, WithTitle, WithEvents, WithMapping
{

    use RegistersEventListeners;
    public Collection $areas;

    /**
     * @throws BindingResolutionException
     */
    public function __construct()
    {
        $this->areas = app()->make(LocationsService::class)->getAll(['depth'=>2]);
    }

    public static function afterSheet(AfterSheet $event)
    {
        $sheet = $event->sheet;
        for ($row = 2; $row < 4; $row++) {
            $objValidation = $sheet->getParent()->getSheet(0)->getCell("L" . $row)->getDataValidation();
            $objValidation->setType(DataValidation::TYPE_LIST);
            $objValidation->setErrorStyle(DataValidation::STYLE_INFORMATION);
            $objValidation->setAllowBlank(false);
            $objValidation->setShowInputMessage(true);
            $objValidation->setShowErrorMessage(true);
            $objValidation->setShowDropDown(true);
            $objValidation->setErrorTitle('Input error');
            $objValidation->setError('Value is not in list.');
            $objValidation->setPromptTitle('Pick from list');
            $objValidation->setPrompt('Please pick a value from list.');
            $objValidation->setFormula1('areas!$A$1:$A$50');
        }
    }

    public function collection()
    {
        return $this->areas;
    }


    /**
     * @return string
     */
    public function title(): string
    {
        return 'areas';
    }


    public function map($row): array
    {
        return [
            $row->title . "#".$row->id
        ];
    }
}
