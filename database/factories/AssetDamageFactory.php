<?php

namespace Database\Factories;

use App\Models\AssetItem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AssetDamage>
 */
class AssetDamageFactory extends Factory
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
            'asset_item_id'  => AssetItem::factory(),
            'reason ' => $this->faker->name,
            'status' => $this->faker->status,
            'reported_by' => $this->faker->name,
            'location_of_damage'  => $this->faker->location,
            'remark' => $this->faker->text,
        ];
    }
}
