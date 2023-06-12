<?php

namespace App\Exports;

use App\Exports\Sheets\PriceTable\CityDropDownSheet;
use App\Exports\Sheets\PriceTable\PriceTableSheet;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class PriceTableExport implements WithMultipleSheets, WithEvents
{
    use Exportable,RegistersEventListeners;
    public function __construct()
    {
    }


    /**
     * @return array
     */
    public function sheets(): array
    {
        $sheets = [];
        $sheets[0] = new PriceTableSheet();
        $sheets[1] = new CityDropDownSheet();
        return $sheets;
    }
}
