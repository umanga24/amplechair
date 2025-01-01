<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Slider;
use Image;
use File;
use Validator;
class SliderController extends Controller{
    protected $slider = null;
    public function __construct(Slider $slider){
        $this->slider = $slider;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        $sliders = $this->slider->orderBy('id', 'DESC')->get();
        return view('admin.slider.list', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $slider_info = null;   
        return view('admin.slider.create', compact( 'slider_info'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $data = $request->all();
        $rules  = $this->AddRules($request);
        $msg = ['dimensions' => "The Slider Image size should be 1350px X 550px."];
        $request->validate($rules, $msg);
        $data['sub_title'] = htmlentities($request->sub_title);
        // dd($data);

        $data['slug']       = $this->getSlug($request->title);
        // dd( $data['slug']);
        $data['added_by'] = $request->user()->id;


        if($request->image){
            $image_title = $this->getSlug($request->title);
            $file_name=$this->imageProcessing($request->image, $image_title, 1350);

            if($file_name){
                $data['image'] = $file_name; 
            }
        }
        
        // dd($data);
        $this->slider->fill($data);
        $success= $this->slider->save();
        
        if($success){
            
            $request->session()->flash('success', 'Slider added Successfully.');
        } else {
            $request->session()->flash('error', 'Error While adding Slider Data.');
        }
      
        return redirect()->route('slider.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $slider_info = $this->slider->find($id);
        if (!$slider_info) {
           $request->session()->flash('error', 'Invalid Slider Id or Slider  not found.');
            return redirect()->route('slider.index');
        }
        return view('admin.slider.create', compact( 'slider_info'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){

        $this->slider = $this->slider->find($id);
        if (!$this->slider) {
            $request->session()->flash('error', 'Slider data not found.');
            return redirect()->route('slider.index');
        }
       


        $data = $request->all();
        $rules  = $this->updateRules($request);
        $msg = ['dimensions' => "The Slider Image size should be 1350px X 550px."];
        $request->validate($rules, $msg);
       
        $data['added_by'] = $request->user()->id;


        if($request->image){
            $image_title =  pathinfo($this->slider->image, PATHINFO_FILENAME);
            $file_name=$this->imageProcessing($request->image, $image_title, 1350);

            if($file_name){
                $data['image'] = $file_name; 
            }
        }
        
        // dd($data);
        $this->slider->fill($data);
        $success= $this->slider->save();
        
        if($success){
            
            $request->session()->flash('success', 'Slider udpated Successfully.');
        } else {
            $request->session()->flash('error', 'Error While adding Slider Data.');
        }
      
        return redirect()->route('slider.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request){
        $slider_id = $this->slider->find($id);
        if (!$slider_id) {
            $request->session()->flash('error', 'Slider data not found.');
            return redirect()->route('slider.index');
        }
        $image = $slider_id->image;
        $inner_image = $slider_id->inner_image;
        $del = $slider_id->delete();
        if ($del) {
        

            if (isset($image) && !empty($image) && file_exists(public_path().'/uploads/slider/banner/'.$image)) {
                unlink((public_path().'/uploads/slider/banner/'.$image));
            }
             
           
            $request->session()->flash('success', 'Slider deleted successfully');
        } else {
            $request->session()->flash('error', 'Sorry! Slider could not be deleted at this moment.');
        }
        return redirect()->route('slider.index');
    }

    public function changeSliderStatus(Request $request){
        $data = $request->all();
        $validation = Validator::make($data, [
            'slider_id'      => 'required|numeric|exists:sliders,id',
            'status'          => 'required|in:Publish,Unpublish',
        ]);

        if ($validation->fails()) {
            foreach ($validation->messages()->getMessages() as $message) {
                $errors[] = $message;
            }    
            return response()->json(['status' => false, 'message' => $errors]);
        }
        $this->slider = $this->slider->find($request->slider_id);
        if (!$this->slider) {
            return response()->json(['status' => false, 'message' => ['Invalid slider information.']]);
        }
        if ($request->status == 'Publish') {
            $data['status'] = 'Unpublish';
        }
        if ($request->status == 'Unpublish') {
            $data['status']= 'Publish';
        }
        $this->slider->fill($data);
        $success= $this->slider->save();
        if ($success) {
            $cat_data = $this->slider->where(['id' => $request->slider_id])->get();
            return response()->json(['status' => true, 'message' => "Slider status updated Successfully.", 'data' => $cat_data]);
        } else {
            return response()->json(['status' => false, 'message' => ["Sorry There was problem while updating slider status. Please Try again later."]]);
        }
    }



    public function AddRules(){
        return [
            'title'     => 'required|string',
            'sub_title' => 'required|string',
            'status'    => 'required|in:Publish,Unpublish',
            'price'     => 'nullable|numeric',
            'image'     =>  'required|mimes:jpg,jpeg,png',
        ];
    }
    public function updateRules(){
        return [
            'title'     => 'required|string',
            'sub_title' => 'required|string',
            'status'    => 'required|in:Publish,Unpublish',
            'price'     => 'nullable|numeric',
            'image'     =>  'nullable|mimes:jpg,jpeg,png',
        ];
    }
    public function getSlug($name){
        $slug = \Str::slug($name);
        $find = $this->slider->where('slug', $slug)->first();
        if($find){
            return false;
        }
        return $slug;
    }
    public function imageProcessing($image,  $image_title, $resulation= null){
        $image_ext = $image->getClientOriginalExtension();
        $image_name = $image_title.'.'.$image_ext;

         
        // $original_path = public_path().'/uploads/courses/';
        $original_path = public_path()."/uploads/slider";
        if(!File::exists($original_path)){
            File::makeDirectory($original_path, 0777, true, true);
        }

        $keep_original = Image::make($image->getRealPath());
        $keep_original->save($original_path.'/'.$image_name);
        if ($resulation != null) {
            $this->resize_image($image_name, $original_path, $resulation, $image_ext );  
        }
 
        return $image_name;     
    }

    public function resize_image($filename, $upload_path =null, $max_resolution, $extension){
        $image_path = $upload_path.'/'.$filename;
        if ( strtolower($extension) === "png") {
            $original_image  = imagecreatefrompng($image_path);
        }
        if ((strtolower($extension) === "jpg") || (strtolower($extension) === "jpeg")) {
            $original_image  = imagecreatefromjpeg($image_path);
        }
        $image_detail = getimagesize($image_path);
        // dd($image_detail);

        $original_width = imagesx($original_image);
        $original_height= imagesy($original_image);
        
        $ratio  = $max_resolution/$original_width;
        $new_width = $max_resolution;
        $new_height = $original_height*$ratio;
        // if that didn't work
        if ($new_height > $max_resolution) {
            $ratio = $max_resolution / $original_height;
            $new_height = $max_resolution;
            $new_width = $original_width*$ratio;
        }
        if ($original_image) {
            $new_image = imagecreatetruecolor($new_width, $new_height);
              imagecopyresampled($new_image, $original_image, 0, 0, 0 ,0, $new_width, $new_height, $original_width, $original_height);
            return imagejpeg($new_image, $image_path, 90);   
        }     
    }
}
