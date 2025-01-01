<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Page extends Model{
    protected $fillable = [
		'title',
		'slug',
		'summary',
		'thumbnail',
		'description',
		'writer',
		'meta_title',
		'meta_description',
		'meta_keyword',
		'meta_keyphrase',
		'page_type',
		'keep_alive',
		'status',
		'added_by',
		'order',
		'name', 
		'page_name',
		'table',
		'is_summary',
		'is_article',
		'show_header',
        'show_footer'
	];
}
