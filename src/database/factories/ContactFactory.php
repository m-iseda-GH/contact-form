<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    public function definition()
    {
        $faker = \Faker\Factory::create('ja_JP');

        return [
            'category_id' => Category::inRandomOrder()->value('id'),

            'first_name' => $faker->firstName(),
            'last_name' => $faker->lastName(),
            'gender' => rand(1, 3),
            'email' => $faker->safeEmail(),
            'tel' => $faker->numerify('090########'),
            'address' => $faker->address(),
            'building' => $faker->optional()->buildingNumber(),

            // realText() だと処理に時間がかかるため、sentences() に変更
            'detail' => implode('', $faker->sentences(3)),
        ];
    }
}
