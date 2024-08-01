<?php

namespace Database\Seeders;

use App\Models\AssetDamage;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AssetDamageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AssetDamage::factory(10)->create();
    }
}
