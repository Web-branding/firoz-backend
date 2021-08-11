<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Treatment extends Model
{
    use HasFactory;
    protected $table = 'treatments';
    protected $fillable = [
        'application_id',
        'file'
    ];

    public function setFileAttribute($value)
    {
        $this->attributes['file'] = json_encode($value);
    }
}
