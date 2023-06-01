<?php

namespace App\Exports;

use App\Exports\Sheets\Awbs\AwbsSheet;
use App\Exports\Sheets\Receiver\AreaDropDownSheet;
use App\Exports\Sheets\Receiver\CityDropDownSheet;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class AwbsExport implements WithMultipleSheets, WithEvents
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
        $sheets[0] = new AwbsSheet();
        $sheets[1] = new CityDropDownSheet();
        $sheets[2] = new AreaDropDownSheet();
        return $sheets;
    }
}
