<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class AwbsWithReferenceExport implements
    WithTitle,
    ShouldAutoSize,
    withHeadings
{
    use Exportable;


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
            'weight',
            'pieces',
            'collection',
            'note1',
            'note2',
            'note3',
            'note4',
            'note5',
        ];
    }
}
