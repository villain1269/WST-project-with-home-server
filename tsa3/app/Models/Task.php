<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    /**
     * TSA3 tasks table: title, status (default 'pending'), task_date.
     */
    protected $fillable = ['title', 'status', 'task_date'];

    protected $attributes = [
        'status' => 'pending',
    ];
}
