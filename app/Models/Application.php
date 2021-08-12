<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $table = 'applications';
    protected $fillable = [
        'application_id',
        'fname',
        'lname',
        'place',
        'address',
        'phone',
        'aadhar',
        'ration',
        'amount',
        'priority',
        'image',
        'file',
        'category'
    ];
}
