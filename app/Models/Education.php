<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;
    protected $table = 'education';
    protected $fillable = [
        'application_id',
        'fee',
        'scholarship',
        'college',
        'course',
        'college_place',
        'certification_no',
    ];
}
