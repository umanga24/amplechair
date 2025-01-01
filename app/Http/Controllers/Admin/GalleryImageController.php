<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Gallery;
use App\Models\Admin\GalleryImage;
use Image;
use File;
use Validator;
class GalleryImageController extends Controller{
    private $gallery_image= null;
    private $gallery  = null;
    public function __construct(Gallery $gallery, GalleryImage $gallery_image){
        $this->gallery = $gallery;
        $this->gallery_image = $gallery_image;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    protected function GalleryImage(Request $request, $id){
        $gallery_info = $this->gallery->find($id);
        $images = null;
        if(!$gallery_info){
            $request->session()->flash('error', 'Invalid Gallery.');
            return redirect()->route('gallery.index');
        }
        $images  = $this->gallery_image->where('gallery_id', $id)->get();
        // dd($images);
        return view('admin.gallery.edit', compact('gallery_info', 'images'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){

        dd($request);

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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        $data = [];
        
        $data['image'] = $request->file('file');
        $data['gallery_id']  = $id;
        $validation = Validator::make($data, [
            'gallery_id'      => 'required|numeric|exists:galleries,id',
            'image'     =>  'required|mimes:jpg,jpeg,png,gif|max:12000|',  
        ]);
        if ($validation->fails()) {
            foreach ($validation->messages()->getMessages() as $message) {
                $errors[] = $message;
            }    
            return response()->json(['status' => false, 'message' => $errors]);
        }

        $data['added_by'] = $request->user()->id;
        // dd($data['image']);
        $this->gallery = $this->gallery->find($id);


        if( $data['image']){
            // $image_title = $this->getSlug($request->title);
            $image_title = $this->gallery->path.'-'.date('Ymdhis').'-'.rand(5001,9999);
            $file_name=$this->imageProcessing( $data['image'], $image_title, $this->gallery->path);
            if($file_name){
                $data['thumbnail'] = $file_name; 
            }
        }
        // dd($file_name);


        $this->gallery_image->fill($data);
        $success= $this->gallery_image->save();
        if($success){
            return response()->json(['status' => true, 'message' => 'Image Uploaded Successfully.']);
            $request->session()->flash('success', 'Gallery Images added Successfully.');
        } else {
            $request->session()->flash('error', 'Error While adding Gallery Images.');
        }

        
    }




    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    protected function deleteGalleryImageById(Request $request){
        $image_data  = $this->gallery_image->find($request->id);

        if (!$image_data) {
            return response()->json(['status' => false, 'message' => ["Invalid Image information."]]);
        }
        $gallery_title = $this->gallery->find($image_data->gallery_id);

        $image= $image_data->thumbnail;
        // dd($gallery_title);
        $del = $image_data->delete();
        if ($del) {
            if (isset($image) && !empty($image) && file_exists(public_path().'/uploads/gallery/'.$gallery_title->path.'/images/'.$image)) {
                unlink((public_path().'/uploads/gallery/'.$gallery_title->path.'/images/'.$image));
            }
            return response()->json([
                'status' => true, 
                'message' => "Gallery image deleted successfully."
            ]);
        } else {
            return response()->json(['status' => false, 'message' => ["Sorry! Gallery Image could not be deleted at this time please reload the page page and try again."]]);
        }
    }

    protected function getAllImagesByGalleryId(Request $request){
        // dd($request);

        $gallery_info = $this->gallery->find($request->id);
        $images = null;
        if(!$gallery_info){
            return response()->json(['status' => false, 'message' => 'Gallery Not found. Please Reload the page']);
        }
        $images  = $this->gallery_image->where('gallery_id', $gallery_info->id)->get();

      
        if($images->count()){
            return response()->json(['status' => true, 'message' => 'Successfully data found.', 'data' => view('admin.gallery.replace-image', compact('images', 'gallery_info'))->render()]);
        }
    }


    public function imageProcessing($image,  $image_title, $path){
        $image_name = $image_title . '.' . $image->getClientOriginalExtension();
        $mainPath = public_path() . "/uploads/gallery/".$path.'/images';
        if (!File::exists($mainPath)) {
            File::makeDirectory($mainPath, 0777, true, true);
        }
        
        $useImage = Image::make($image->getRealPath());
        $useImage->save($mainPath . '/' . $image_name);
        // dd($image->getSize());
        if(($image->getSize() > 50000) && ($image->getClientOriginalExtension() != 'gif')){
            $this->resize_image($image_name, $mainPath, 1000, $image->getClientOriginalExtension());
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
