<?php

namespace Database\Factories\Modules\Address\Models;

use App\Helpers\SlugGenerator;
use App\Modules\Address\Models\AddressModel;
use App\Modules\Person\Models\PersonModel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class AddressModelFactory extends Factory
{
    protected $model = AddressModel::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $personSlug = PersonModel::count() >= 7 ? PersonModel::inRandomOrder()->first()->slug: PersonModel::factory();

        return [
            'slug' => SlugGenerator::generateSlug(),
            'person_slug' => $personSlug,
            'post_code' => $this->faker->numerify('#####'),
            'address' => $this->faker->address(),
            'city_name' => $this->faker->city(),
            'country_name' => $this->faker->country(),
            'is_active' => 1
        ];
    }
}
