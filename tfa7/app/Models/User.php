<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    /**
     * TFA7 users table: username (unique), full_name, avatar (nullable
     * path on the public disk). Replaces the skeleton's auth User model —
     * delete the skeleton's default users migration before migrating.
     */
    protected $fillable = ['username', 'full_name', 'avatar'];
}
