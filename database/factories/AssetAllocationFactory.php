<?php

namespace Database\Factories;

use App\Models\AssetItem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AssetAllocation>
 */
class AssetAllocationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'date' => $this->faker->date,
            'allocated_from' => $this->faker->name,
            'allocated_to' => $this->faker->name,
            'asset_item_id' => AssetItem::factory(),
        ];
    }
}
