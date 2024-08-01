<?php

namespace Database\Seeders;

use App\Models\AssetAllocation;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AssetAllocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AssetAllocation::factory(10)->create();
    }
}
