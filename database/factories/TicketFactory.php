<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::factory();
        return [
            'created_by' => $user,
            'client_id' => Client::factory(),
            'client_name' => $this->faker->name,
            'client_phone' => $this->faker->phoneNumber,
            'reported_issue' => $this->faker->sentence,
            'status' => $this->faker->randomElement(['open', 'in_progress', 'finished', 'scheduled']),
            'solution' => $this->faker->paragraph,
            'observation' => $this->faker->paragraph,
            'finished_at' => $this->faker->boolean ? now() : null,
            // 'scheduling_date' => now(),
            'finished_by' => $user,
        ];
    }
}
