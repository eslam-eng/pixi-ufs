<?php

namespace App\Exports\Sheets\Receiver;

use App\Enum\Tenant\ProductSellerStatus;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;

class ReceiversSheet implements
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
        return 'receivers';
    }

    public function headings(): array
    {
        return [
            'reference',
            'name',
            'phone1',
            'city',//D
            'area',//E
            'phone2',
            'branch',
            'address1',
            'address2',
            'lat',
            'lng',
            'map_url',
            'receiving_company',
            'receiving_branch',
            'title',
        ];
    }
}
