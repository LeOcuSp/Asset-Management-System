<?php

use Illuminate\Support\Facades\Route;

use App\Exports\SampleAssetItemExport;
use Maatwebsite\Excel\Facades\Excel;

// routes/web.php

Route::get('download-sample-excel', function () {
    $sampleData = [
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

    return Excel::download(new SampleAssetItemExport($sampleData), 'sample_asset_items.xlsx');
})->name('download-sample-excel');