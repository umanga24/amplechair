<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class GalleryImage extends Model{
    protected $fillable = ['title', 'gallery_id', 'thumbnail', 'order', 'added_by', 'status', 'table'];
    
}
