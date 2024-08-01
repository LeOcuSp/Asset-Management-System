<?php

namespace App\Exports;

use App\Models\AssetItem;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class AssetItemExport implements FromCollection, WithMapping , WithHeadings
{
    use Exportable;

    public function __construct(public Collection $records)
    {
        // $this->records = $records;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->records;
    }

    public function map($asset_item): array
    {
        return [
            $asset_item->name,
            $asset_item->category->name,
            $asset_item->brand,
            $asset_item->model,
            $asset_item->date_of_purchase,
            $asset_item->serial_number,
            $asset_item->asset_number,
            $asset_item->status,
            $asset_item->date_of_warranty,
            $asset_item->donor->name,
            $asset_item->location,
            $asset_item->vendor,
            $asset_item->purchased_price,

        ];
    }

    public function headings():array

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
