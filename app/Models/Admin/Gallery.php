<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model{
    protected $fillable = [
        'title', 
        'slug', 
        'thumbnail', 
        'order', 
        'added_by', 
        'status', 
        'table', 
        'meta_title', 
        'meta_description', 
        'meta_keyword', 
        'meta_keyphrase',
        'path'
    ];
    public function ImageList(){
        return $this->hasMany('App\Models\Admin\GalleryImage', 'gallery_id', 'id');
    }
}
