<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'designation',
        'salary',
        'gender',
        'hobby',
        'image',
        'status',
        'display_order',
        'created_date',
        'updated_date',
    ];
}
