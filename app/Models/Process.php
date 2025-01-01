<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Process extends Model
{
    // use HasFactory;
    protected $fillable = ['process_title',' process_description','process_image','process_banner_image'];

}
