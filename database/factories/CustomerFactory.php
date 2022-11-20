<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->unique()->phoneNumber(),
            'country' => $this->faker->country(),
            'city' => $this->faker->city(),
            'street' => $this->faker->streetAddress(),
            'post_code' => $this->faker->postcode(),
            'contact_person_name' => $this->faker->firstName()." ".$this->faker->lastName(),
            'contact_person_phone' => $this->faker->phoneNumber(),
            'contact_person_email' => $this->faker->unique()->safeEmail(),
        ];
    }


}
