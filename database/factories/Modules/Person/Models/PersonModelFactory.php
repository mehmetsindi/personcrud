<?php

namespace Database\Factories\Modules\Person\Models;

use App\Helpers\SlugGenerator;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PersonModelFactory extends Factory
{

    protected $model = \App\Modules\Person\Models\PersonModel::class;

    public function definition()
    {
        return [
            'slug' => SlugGenerator::generateSlug(),
            'name' => $this->faker->name(),
            'birthday' => $this->faker->date(),
            'gender' => $this->faker->randomElement([
                'male',
                'female',
                'other'
            ]),
            'is_active' => 1,
            'created_at' => now()
        ];
    }
}
