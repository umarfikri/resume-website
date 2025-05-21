<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Model
{
    use HasFactory;

    // Set the table name if it's not 'users'
    protected $table = 'users';

    // Set which attributes can be mass-assigned
    protected $fillable = [
        'username',
        'password',
        'userLevel',
    ];

    // Hide attributes when converting to JSON
    protected $hidden = [
        'password',
    ];

}
