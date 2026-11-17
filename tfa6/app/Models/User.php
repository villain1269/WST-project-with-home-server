<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    /**
     * TFA6 users table: username (unique), full_name (see migration).
     *
     * Note: this intentionally replaces the Laravel skeleton's default
     * auth-oriented User model — TFA6 only lists accounts, it does not
     * log anyone in. Delete the skeleton's default
     * 0001_01_01_000000_create_users_table migration so this project's
     * own users migration is the one that runs (see CHANGELOG.md).
     */
    protected $fillable = ['username', 'full_name'];
}
