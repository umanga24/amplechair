<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Product extends Model{
    protected $fillable = [
        'title',
        'summary',
        'highlight',
        'description',
        'slug',
        'image',
        'cat_id',
        'price',
        'discount',
        'brand',
        'model',
        'added_by',
        'path',
        'status',
        'sale',
        'meta_title',
        'meta_keyword',
        'meta_description',
        'meta_keyphrase',
        'view',
        'is_featured',
        'search',
        'is_other',
        'product_description'
    ];
    public function category_info(){
        return $this->hasOne(  'App\Models\Admin\Category',   'id',   'cat_id');
    }
    public function subcat_info(){
        return $this->hasOne( 'App\Models\Admin\Category', 'id', 'child_cat_id');
    }
    public function ListAllProducts(){
        return $this->with( ['category_info', 'subcat_info'])->get();
    }

    public function other_image(){
    	return $this->hasMany('App\Models\Admin\ProductImage', 'product_id', 'id');
    }

    public function category(){
    	return $this->belongsTo('App\Models\Admin\Category', 'cat_id');
    }

}
