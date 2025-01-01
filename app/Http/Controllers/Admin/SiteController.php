<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Site;
use File;
use Image;
class SiteController extends Controller{
    private $site = null;
    public function __construct(Site $site){
    	$this->site = $site;
    }
    public function allInfo(Request $request){
    	$web_info =$this->site->first();
    	return view('admin.website.web-panel', compact('web_info'));
    }
    public function updateAddress(Request $request){
        // dd($request);

		$act = "add";
        $rules = $this->FreshGetRules();
        // dd($rules);
        $request->validate($rules);
        
        $data = $request->all();
    	$all_row = $this->site->first();
        $data['added_by'] = $request->user()->id;
        
        if($request->logo){
            $image_name = $this->ImageProcessing($request->logo, 'logo');
            if($image_name){
                $data['logo'] = $image_name;
            }
        }
        
        if($request->fab_icon){
            // dd($request);
        $fab_icon = $this->ImageProcessing($request->fab_icon, 'fab_icon');
            if($fab_icon){
                $data['fab_icon'] = $fab_icon;
            }
        }


    	if(isset($all_row) && !empty($all_row)){
    		if($all_row->count()){
            	$act = "updat";
	            $all_row->fill($data);
    			$success= $all_row->save();
    		} else {
	        	$this->site->fill($data);
        		$success= $this->site->save();
    		}
    	}else{
	        $this->site->fill($data);
        	$success= $this->site->save();
    	}
        if($success){
            $request->session()->flash('success', 'Website Information '.$act.'ed Successfully.');
        } else {
            $request->session()->flash('error', 'Error While '.$act.'ing website Information.');
        }

        return redirect()->route('web-setting');
    }





    public function FreshGetRules(){
        return [
        	'country'			=>  'nullable|string',
            'company_name'		=>  'nullable|string',
            'location'			=> 	'nullable|string',
            'district'         	=>  'nullable|string',
            'municipality'      =>  'nullable|string',
            'city'       		=>  'nullable|string',
            'ward_no'          	=>  'nullable|numeric',
			'logo' 				=>  'nullable|mimes:png,jpg,jpeg|max:1000',
            'facebook_page'     =>  'nullable|string',
            'twitter_id'        =>  'nullable|string',
			'insta_id'			=>  'nullable|string',
			'pinterest_id'		=>	'nullable|string',
			'rss_id'			=>	'nullable|string',
            'youtube_channel'   =>  'nullable|string',
            'phone_one'         =>  'nullable|string',
            'phone_two'         =>  'nullable|string',
           	'email'           	=>  'nullable|email',
            'go_live'           =>  'nullable|in:0,1',
            'mail_sender_email' => 'nullable|email',
            'tumblr'            =>  'nullable|string',
            'map'               =>  'nullable|string'
        ];
    }



    public function ImageProcessing($image, $image_type){
        $image_ext = $image->getClientOriginalExtension();
        // dd($image_ext);
        if($image_type == 'logo'){
            $image_name = 'logo.'.$image_ext;
        }else if($image_type == 'fab_icon'){
            $image_name = 'fab-icon.'.$image_ext;
        }
        $original_path = public_path()."/uploads/logo";
        if(!File::exists($original_path)){
            File::makeDirectory($original_path, 0777, true, true);
        }
        $keep_original = Image::make($image->getRealPath());
        $keep_original->save($original_path.'/'.$image_name);

        return $image_name;
    }
}
