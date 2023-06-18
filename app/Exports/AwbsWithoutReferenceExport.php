<?php

namespace App\Exports;

use App\Exports\Sheets\Awbs\AwbsWithoutReferenceSheet;
use App\Exports\Sheets\general\AreaDropDownSheet;
use App\Exports\Sheets\general\CityDropDownSheet;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class AwbsWithoutReferenceExport implements WithMultipleSheets,WithEvents
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
        $sheets[0] = new AwbsWithoutReferenceSheet();
        $sheets[1] = new CityDropDownSheet();
        $sheets[2] = new AreaDropDownSheet();
        return $sheets;
    }
}
