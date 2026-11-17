<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    /**
     * TFA6 customers table: full_name, email, phone (see migration).
     */
    protected $fillable = ['full_name', 'email', 'phone'];
}
