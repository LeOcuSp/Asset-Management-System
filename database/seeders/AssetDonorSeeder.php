<?php

namespace Database\Seeders;

use App\Models\AssetDonor;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AssetDonorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AssetDonor::factory(10)->create();
    }
}
