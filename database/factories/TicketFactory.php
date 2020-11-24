<?php

namespace Database\Factories;

use App\Models\Ticket;
use Illuminate\Database\Eloquent\Factories\Factory;

class TicketFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Ticket::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'customer_name' => $this->faker->name,
            'email' => $this->faker->unique()->email,
            'description' => $this->faker->paragraph,
            'telephone' => $this->faker->phoneNumber,
            'reference_number' => uniqid('osp-')
        ];
    }
}
