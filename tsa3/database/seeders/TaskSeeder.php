<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * 8 tasks spanning 3 different dates, including today's date.
     * Dates are computed at seed time, so "today" is always genuinely
     * today whenever the seeder runs.
     */
    public function run(): void
    {
        $today = now()->startOfDay();

        $tasks = [
            ['title' => 'Submit the TSA3 write-up',                 'status' => 'done',    'task_date' => $today],
            ['title' => 'Review the Eloquent whereDate query',      'status' => 'done',    'task_date' => $today],
            ['title' => 'Record the demo walkthrough',              'status' => 'pending', 'task_date' => $today],
            ['title' => 'Finish the Profile page',                  'status' => 'pending', 'task_date' => $today],
            ['title' => 'Write the GitHub README',                  'status' => 'done',    'task_date' => $today->copy()->subDay()],
            ['title' => 'Seed realistic sample tasks',              'status' => 'done',    'task_date' => $today->copy()->subDay()],
            ['title' => 'Create the tasks migration',               'status' => 'done',    'task_date' => $today->copy()->subDays(2)],
            ['title' => 'Plan the Tasks for Today schema',          'status' => 'done',    'task_date' => $today->copy()->subDays(2)],
        ];

        foreach ($tasks as $task) {
            Task::create($task);
        }
    }
}
