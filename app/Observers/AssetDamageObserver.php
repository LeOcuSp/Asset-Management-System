<?php
// namespace App\Observers;

// use App\Models\AssetDamage;
// use App\Models\AssetItem;

// class AssetDamageObserver
// {
//     public function updating(AssetDamage $assetDamage)
//     {
//         $assetItem = AssetItem::find($assetDamage->asset_item_id);
//         if ($assetItem) {
//             if (in_array($assetDamage->status, ['damage', 'stolen', 'lost','repair'])) {
//                 $assetItem->update(['status' => 'Inactive']);
//             } elseif ($assetDamage->status === 'repair') {
//                 $assetItem->update(['status' => 'Active']);
//             }
//         }
//     }
// }
