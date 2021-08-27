<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;
    protected $table = 'videos';
    protected $fillable = [
        'title', 'description', 'video', 'file'
    ];

    public function setFileAttribute($value)
    {
        $this->attributes['file'] = json_encode($value);
    }
}
