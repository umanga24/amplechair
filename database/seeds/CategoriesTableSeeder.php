<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        $array =[
            ['title'  => 'kitchen','slug' =>'kitchen','is_parent' =>1,'show_in_menu' => 1],
            // ['title'  => 'tops','slug' =>'tops','is_parent' =>1, 'parent_id' => 1, 'show_in_menu' => 1],
            // ['title'  => 'dresses','slug' =>'dresses','is_parent' =>1, 'parent_id' => 1, 'show_in_menu' => 1],
            ['title'  => 'living room','slug' =>'living-room','is_parent' =>1,'show_in_menu' => 1],
            ['title'  => 'men','slug' =>'men','is_parent' =>1,'show_in_menu' => 1],
            ['title'  => 'activewear','slug' =>'activewear','is_parent' =>1,'show_in_menu' => 1],
            ['title'  => 'accessories','slug' =>'accessories','is_parent' =>1,'show_in_menu' => 1],
            // ['title'  => 'sale','slug' =>'sale','is_parent' =>1,'show_in_menu' => 1],
            // ['title'  => 'inspiration','slug' =>'inspiration','is_parent' =>1,'show_in_menu' => 1],
             
        ];
        DB::table('categories')->insert($array);
    }
}
