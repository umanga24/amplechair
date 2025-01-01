<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model{
    protected $fillable = ['title', 'sub_title', 'slug', 'status', 'added_by', 'image', 'link', 'price'];
}
