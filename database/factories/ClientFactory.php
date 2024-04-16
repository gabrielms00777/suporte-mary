<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'created_by' => User::factory(),
            'business_name' => $this->faker->company,
            'contact_person' => $this->faker->name,
            'address' => $this->faker->streetAddress,
            'postal_code' => $this->faker->postcode,
            'number' => $this->faker->buildingNumber,
            'city' => $this->faker->city,
            'complement' => $this->faker->secondaryAddress,
            'cpf_cnpj' => $this->faker->unique()->numerify('##############'),
            'phone1' => $this->faker->phoneNumber,
            'phone2' => $this->faker->phoneNumber,
            'contract' => $this->faker->boolean,
            'system' => $this->faker->word,
            'status' => $this->faker->randomElement(['active', 'inactive', 'blocked']),
        ];
    }
}
