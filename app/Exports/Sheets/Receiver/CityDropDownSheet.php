<?php

namespace App\Exports\Sheets\Receiver;

use App\Services\LocationsService;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Cell\DataValidation;

class CityDropDownSheet implements FromCollection, WithTitle, WithEvents, WithMapping
{

    use RegistersEventListeners;

    public Collection $cities;

    public function __construct()
    {
        $this->cities = app()->make(LocationsService::class)->getAll(['depth'=>1]);

    }

    public static function afterSheet(AfterSheet $event)
    {
        $sheet = $event->sheet;
        for ($row = 2; $row < 100; $row++) {
            $objValidation = $sheet->getParent()->getSheet(0)->getCell("H" . $row)->getDataValidation();
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
            $objValidation->setFormula1('cities!$A$1:$A$50');
        }
    }

    public function collection()
    {
        return $this->cities;
    }


    /**
     * @return string
     */
    public function title(): string
    {
        return 'cities';
    }


    public function map($row): array
    {
        return [
            $row->title . "#".$row->id
        ];
    }
}
