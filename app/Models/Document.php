<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Document extends Model
{
    use HasFactory;

    // Set the table name if it's not 'users'
    protected $table = 'documents';

    // Set which attributes can be mass-assigned
    protected $fillable = [
        'documentName',
        'documentUrl',
    ];    

}
