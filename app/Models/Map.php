<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Map extends Model
{
    // use HasFactory;
    protected $fillabe = ['title', 'description', 'map_image',];
}
