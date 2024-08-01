<?php

namespace Database\Factories;

use App\Models\AssetItem;
use App\Models\AssetDamage;
use App\Models\AssetCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AssetItem>
 */
class AssetItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'asset_category_id' => AssetCategory::factory(),
            'asset_damage_id' => AssetDamage::factory(),
            'brand' => $this->faker->word,
            'model' => $this->faker->word,
            'date_of_purchase' => $this->faker->date,
            'description' => $this->faker->sentence,
            'serial_number' => $this->faker->word,
            'asset_number' => $this->faker->word,
            'date_of_warranty' => $this->faker->date,
            'asset_donor_id' => $this->faker->numberBetween(1, 10),
            'location' => $this->faker->word,
            'vendor' => $this->faker->word,
            'purchased_price' => $this->faker->randomFloat(2, 1, 1000),
            'remark' => $this->faker->word,
            'status' => $this->faker->randomElement(['Active', 'Inactive']),
            'asset_allocation_id' => $this->faker->numberBetween(1, 10),
        ];
    }
}
