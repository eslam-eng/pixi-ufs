<?php

namespace App\Exports\Sheets\Receiver;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Cell\DataValidation;

class BranchesDropDownSheet implements FromCollection, WithTitle, WithEvents, WithMapping
{

    use RegistersEventListeners;

    public function __construct(public Collection $branches)
    {
    }

    public static function afterSheet(AfterSheet $event): void
    {
        $sheet = $event->sheet;
        for ($row = 2; $row < 4; $row++) {
            $objValidation = $sheet->getParent()->getSheet(0)->getCell("G" . $row)->getDataValidation();
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
            $objValidation->setFormula1('branches!$A$1:$A$50');
        }
    }

    public function collection(): Collection
    {
        return $this->branches;
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'companies&branches';
    }


    public function map($row): array
    {
        return [
            'company : '.$row->company->name . "$" . $row->company->id ."branch : " . $row->name . "#".$row->id
        ];
    }
}
