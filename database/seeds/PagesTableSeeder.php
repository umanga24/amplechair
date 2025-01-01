<?php

use Illuminate\Database\Seeder;

class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        $data = [
            [
    			'title' => 'about us',
    			'slug' =>  'about',
                'name'  => 'about',
                'page_name' => 'about',
    			'status' => 'Publish',
    			'page_type' => 'article',
    			'keep_alive' => 'keep_alive',
            ],
            [
                'title' => 'contact',  
                'slug' => 'contact-us', 
                'name'  => 'contact us',
                'page_name' => 'contact-us',
                'status' => 'Publish', 
                'page_type' => 'non-article', 
                'keep_alive' => 'keep_alive'  
            ],
            [
                'title' => 'Home',  
                'slug' => 'index',
                'name'  => 'Home',
                'page_name' => 'index', 
                'status' => 'Publish', 
                'page_type' => 'non-article', 
                'keep_alive' => 'keep_alive'  
            ],
            [
                'title' => 'blog',  
                'slug' => 'blog',
                'name'  => 'blog',
                'page_name' => 'blog', 
                'status' => 'Publish', 
                'page_type' => 'non-article', 
                'keep_alive' => 'keep_alive'  
            ],
            [
                'title' => 'Product',  
                'slug' => 'product',
                'name'  => 'product',
                'page_name' => 'product', 
                'status' => 'Publish', 
                'page_type' => 'non-article', 
                'keep_alive' => 'keep_alive'  
            ],
            [
                'title' => 'Gallery',  
                'slug' => 'gallery',
                'name'  => 'Gallery',
                'page_name' => 'gallery', 
                'status' => 'Publish', 
                'page_type' => 'non-article', 
                'keep_alive' => 'keep_alive'  
            ],
            [
                'title' => 'Terms and Conditions',  
                'slug' => 'terms-and-conditions',
                'name'  => 'Terms And Conditions',
                'page_name' => 'terms-and-conditions', 
                'status' => 'Publish', 
                'page_type' => 'article', 
                'keep_alive' => 'keep_alive'  
            ],
            [
                'title' => 'Privacy Policy',  
                'slug' => 'privacy-policy',
                'name'  => 'Privacy Policy',
                'page_name' => 'privacy-policy', 
                'status' => 'Publish', 
                'page_type' => 'article', 
                'keep_alive' => 'keep_alive'  
            ],
            [
                'title' => 'Trainning',  
                'slug' => 'Trainning',
                'name'  => 'Trainning',
                'page_name' => 'Trainning', 
                'status' => 'Publish', 
                'page_type' => 'article', 
                'keep_alive' => 'keep_alive'  
            ],
        ];
        DB::table('pages')->insert($data); 

    }
}
