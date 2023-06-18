<?php

namespace App\Exports\Sheets\PriceTable;

use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class PriceTableSheet implements
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
        return 'prices';
    }

    public function headings(): array
    {
        return [
            'location_from',
            'location_to',
            'price',
            'additional_kg_price',
            'basic_kg',
            'return_price',
            'special_price',
        ];
    }
}
