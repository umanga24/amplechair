<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Category extends Model{
    protected $fillable = [
        'title', 
        'slug', 
        'summary', 
        'image', 
         'image1', 
        'is_parent', 
        'parent_id', 
        'show_in_menu', 
        'status', 
        'added_by', 
        'category_type', 
        'show_order', 
        'is_featured',
        'banner_category',
        'description'
    ];

    public function parent_info(){
        return $this->hasOne('App\Models\Admin\Category', 'id', 'parent_id');
      }

      public function subcategories()
    {
        return $this->hasMany('App\Models\Admin\Category','parent_id')->where('status', '=', 'Publish');
    }
      
    public function getChild($parent_id){
        return $this->where('parent_id',$parent_id)->get();
    }

    //front category controlling 
    public function AllSubCat(){
        return $this->hasMany('App\Models\Admin\Category', 'parent_id', 'id')->where('status', '=', 'Publish');
    }
    public function homeProduct(){
        return $this->hasMany('App\Models\Admin\Product', 'cat_id', 'id')->where('status', 'Publish')->limit(4);
    }

    public function products(){
        return $this->hasMany('App\Models\Admin\Product','cat_id', 'id')->where('status', 'Publish');
      }
}
