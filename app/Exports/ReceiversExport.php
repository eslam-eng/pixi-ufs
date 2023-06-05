<?php

namespace App\Exports;

use App\Exports\Sheets\Receiver\AreaDropDownSheet;
use App\Exports\Sheets\Receiver\BranchesDropDownSheet;
use App\Exports\Sheets\Receiver\CityDropDownSheet;
use App\Exports\Sheets\Receiver\AwbsSheet;
use App\Exports\Sheets\Receiver\ReceiversSheet;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ReceiversExport implements WithMultipleSheets, WithEvents
{
    use Exportable,RegistersEventListeners;
    public function __construct(public $branches)
    {
    }


    /**
     * @return array
     */
    public function sheets(): array
    {
        $sheets = [];
        $sheets[0] = new ReceiversSheet();
        $sheets[1] = new BranchesDropDownSheet($this->branches);
        $sheets[2] = new CityDropDownSheet();
        $sheets[3] = new AreaDropDownSheet();
        return $sheets;
    }
}
