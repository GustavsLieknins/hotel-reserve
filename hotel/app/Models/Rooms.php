<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rooms extends Model
{
    use HasFactory;

    protected $appends = ['img_url'];

    protected $fillable = [
        'name',
        'price',
        'description',
        'img_url',
        'location',
        'availability',
        'max_availability',
        'created_by',
    ];

    public function img_url()
    {
        return asset('storage/rooms/' . $this->image);
    }
}

