<?php

namespace App\Exports\Sheets\Awbs;

use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class AwbsSheet implements
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
            'phone',
            'receiving_company',
            'title',
            'address',
            'company_Name',
            'contact_name',
            'address',
            'city',//K
            'area',//L
        ];
    }
}
