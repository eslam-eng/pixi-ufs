<?php

namespace App\Exports\Sheets\Awbs;

use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class AwbsWithoutReferenceSheet implements
    WithTitle,
    WithEvents,
    ShouldAutoSize,
    withHeadings
{
    use RegistersEventListeners;


    public function __construct()
    {
    }


    /**
     * @return string
     */
    public function title(): string
    {
        return 'awbs';
    }

    public function headings(): array
    {
        return [
            'reference',
            'name',
            'phone1',
            'city',//D
            'area',//E
            'weight',
            'pieces',
            'collection',
            'receiving_company',
            'receiving_branch',
            'title',
            'address1',
            'phone2',
            'note1',
            'note2',
            'note3',
            'note4',
            'note5',
        ];
    }
}
