<?php

namespace Database\Seeders;

use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Task::factory()->count(3)->create();

        Task::factory()->count(2)->withoutDescription()->create();

        Task::factory()->count(2)->withDueDate(Carbon::tomorrow())->create();
    }
}
