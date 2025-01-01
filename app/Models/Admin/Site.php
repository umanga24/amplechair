<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Site extends Model{
    protected $fillable = [
    	'country',
    	'company_name',
    	'district',
        'location',
    	'municipality',
    	'city',
    	'ward_no',
    	'facebook_page',
    	'twitter_id',
		'insta_id',
		'pinterest_id',
		'rss_id',
    	'youtube_channel',
		'logo',
		'fab_icon',
    	'phone_one',
    	'phone_two',
    	'email',
        'map',
    	'go_live',
		'added_by',
		'mail_sender_email',


		'sliders',
		'categories',
		'blogs',
		'messages',
		'products',
		'pages',
		'orders',
		'subscribers',
        'media_logo'
	];
}
