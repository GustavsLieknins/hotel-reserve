<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rooms extends Model
{
    use HasFactory;

    protected $appends = ['img_url'];

    public function img_url()
    {
        return asset('storage/rooms/' . $this->image);
    }
}

