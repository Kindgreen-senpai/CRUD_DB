<?php

namespace Database\Factories;

use Propaganistas\LaravelPhone\PhoneNumber;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Worker>
 */
class WorkerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    { 
        // $phone = new PhoneNumber(fake()->phoneNumber());
        return [
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'email' => fake()->unique()->safeEmail(),
            'job' =>  "PHP developer",
            'salary' =>  fake()->numberBetween(500,1000),
            'hire_date' =>  fake()->dateTimeBetween('-5 week', '-1 week'),
            'phone' => fake()->e164PhoneNumber(),
        ];       
        
    }
}
