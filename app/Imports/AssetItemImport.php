<?php

namespace App\Imports;

use App\Models\AssetItem;
use App\Models\AssetDonor;
use App\Models\AssetDamage;
use App\Models\AssetCategory;
use App\Models\AssetAllocation;
use Maatwebsite\Excel\Concerns\ToModel;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AssetItemImport implements ToModel, WithHeadingRow
{
    use Importable;
    
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new AssetItem([
            'name' => $row['name'],
            'asset_category_id' => $this->getCategoryId($row['category']),
            'asset_damage_id' => isset($row['asset_damage']) ? $this->getAssetDamageId($row['asset_damage']) : null, // Assuming you have asset_damage_id field
            'brand' => $row['brand'],
            'model' => $row['model'],
            'date_of_purchase' => Date::excelToDateTimeObject($row['date_of_purchase']),
            'description' => $row['description'],
            'serial_number' => $row['serial_number'],
            'asset_number' => $row['asset_number'],
            'date_of_warranty' => Date::excelToDateTimeObject($row['date_of_warranty']),
            'asset_donor_id' => $this->getDonorId($row['donor']),
            'location' => $row['location'],
            'vendor' => $row['vendor'],
            'purchased_price' => $this->getPurchasedPrice($row['purchased_price']),
            'remark' => isset($row['remark']) ? $row['remark'] : '',
            'status' => $row['status'],
            'asset_allocation_id' => isset($row['allocation']) ? $this->getAllocationId($row['allocation']) : null // Assuming you have asset_allocation_id field
        ]);
    }

    private function getPurchasedPrice($price)
    {
        return floor((float)$price);
    }

    private function getCategoryId(string $category)
    {
        $category = AssetCategory::firstOrCreate(['name' => $category]);
        return $category->id;
    }

    private function getDonorId(string $donor)
    {
        $donor = AssetDonor::firstOrCreate(['name' => $donor]);
        return $donor->id;
    }

    private function getAssetDamageId(string $asset_damage)
    {
        
        $assetDamage = AssetDamage::firstOrCreate(['name' => $asset_damage]);
        return $assetDamage->id;
    }

    private function getAllocationId(string $allocation)
    {
        
        $allocation = AssetAllocation::firstOrCreate(['name' => $allocation]);
        return $allocation->id;
    }
}
