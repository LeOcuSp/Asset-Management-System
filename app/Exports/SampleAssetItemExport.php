<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\AssetItem;

class SampleAssetItemExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return AssetItem::all();
    }

    public function headings(): array
    {
        return [
            'Name',
            'Category',
            'Brand',
            'Model',
            'Date of Purchase',
            'Serial Number',
            'Asset Number',
            'Status',
            'Date of Warranty',
            'Donor',
            'Location',
            'Vendor',
            'Purchase Price'
        ];
    }
}