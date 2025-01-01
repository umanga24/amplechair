<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    // use HasFactory;
    protected $fillable=['post_title','post_description','banner_image','name','email','phone','post_image','status','banner_image'];
}
