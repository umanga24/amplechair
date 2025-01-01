<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Post extends Model{
    protected $fillable = [
        'title', 
        'summary', 
        'description', 
        'slug',   
        'thumbnail', 
        'writer', 
        'status',  
        'published_date', 
        'meta_title', 
        'meta_description',  
        'meta_keyword', 
        'meta_keyphrase',
        'added_by',  
        'page_title',
        'name',
        'order',
        'table',
    ];

}
