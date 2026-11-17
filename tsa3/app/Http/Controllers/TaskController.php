<?php

namespace App\Http\Controllers;

use App\Models\Task;

class TaskController extends Controller
{
    /**
     * Welcome page: only the tasks whose task_date is today.
     * Laravel runs in the Asia/Manila timezone so "today" matches the
     * student's calendar day regardless of the server's UTC default
     * (see config/app.php note in CHANGELOG.md).
     */
    public function welcome()
    {
        $today = now()->toDateString();

        return view('welcome', [
            'today' => $today,
            'tasks' => Task::whereDate('task_date', $today)
                ->orderBy('task_date')
                ->get(),
        ]);
    }

    /**
     * Task List page: every task, ordered by date.
     */
    public function index()
    {
        return view('tasks', [
            'tasks' => Task::orderBy('task_date')->get(),
        ]);
    }
}
