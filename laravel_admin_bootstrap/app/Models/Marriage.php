<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marriage extends Model
{
    use HasFactory;
    protected $table = 'marriages';
    protected $fillable = [
        'application_id',
        'fname',
        'lname',
        'place',
        'address',
        'amount',
        'priority',
        'image',
        'ref_file',
        'file'
    ];

    public function setFileAttribute($value)
    {
        $this->attributes['file'] = json_encode($value);
    }
}
