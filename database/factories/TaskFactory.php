<?php

namespace Database\Factories;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'status' => $this->faker->randomElement(['pending', 'completed']),
            'user_id' => auth()->id() ?? 1,
            'category_id' => Category::all()->random(),
        ];
    }

    public function withDueDate(Carbon $date): TaskFactory|Factory
    {
        return $this->state(fn(array $attributes) => [
            'due_date' => $date
        ]);
    }

    public function withoutDescription(): TaskFactory|Factory
    {
        return $this->state(fn(array $attributes) => [
            'description' => null
        ]);
    }
}
