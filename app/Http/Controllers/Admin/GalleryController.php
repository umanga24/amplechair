<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Gallery;
use App\Models\Admin\GalleryImage;
use File;
use Validator;
use Image;
class GalleryController extends Controller
{
    private $gallery = null;
    public function __construct(Gallery $gallery, GalleryImage $gallery_image)
    {
        $this->gallery  = $gallery;
        $this->gallery_image  = $gallery_image;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_galleries = $this->gallery->orderBy('id', 'DESC')->get();
        return view('admin.gallery.list', compact('all_galleries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $gallery_info = null;
        return view('admin.gallery.create')->with('gallery_info', $gallery_info);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        // dd($request->all());
        $rules  = $this->AddRules($request);
        $request->validate($rules);
        $data = $request->all();
        $data['slug'] = $this->getSlug($request->title);
        // dd($data['slug'].'-'.date('Y-m-d-h-i-s'));
        $data['path'] = $data['slug'].'-'.date('Ymd-his');
        if ($request->thumbnail) {
            $file_name = $this->imageProcessing($request->thumbnail, $data['path'] );

            if ($file_name) {
                $data['thumbnail'] = $file_name;
            }
        }
        $data['added_by'] = $request->user()->id;
        $this->gallery->fill($data);
        $success= $this->gallery->save();
        
        if($success){
            $request->session()->flash('success', 'Gallery added Successfully.');
        } else {
            $request->session()->flash('error', 'Error While adding Gallery.');
        }
      
        return redirect()->route('gallery.index');
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
    public function edit($id, Request $request){
       
        $this->gallery = $this->gallery->find($id);
        if (!$this->gallery) {
            $request->session()->flash('error', 'Invalid Gallery or Gallery  not found.');
            return redirect()->route('gallery.index');
        }
          // dd($this->gallery);
        return view('admin.gallery.create')
        ->with('gallery_info', $this->gallery);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        // dd($request->all());
        $rules  = $this->UpdateRules($request);
        $request->validate($rules);

        $this->gallery = $this->gallery->find($id);
        if(!$this->gallery){
            $request->session()->flash('error', 'Invalid Gallery Id');
            return redirect()->route('gallery.index');
        }
        $data = $request->all();
       
        if ($request->thumbnail) {
            $file_name = $this->imageProcessing($request->thumbnail, $this->gallery->path );

            if ($file_name) {
                $data['thumbnail'] = $file_name;
            }
        }
        $data['added_by'] = $request->user()->id;
        $this->gallery->fill($data);
        $success= $this->gallery->save();
        
        if($success){
            $request->session()->flash('success', 'Gallery updated Successfully.');
        } else {
            $request->session()->flash('error', 'Error While updating Gallery.');
        }
      
        return redirect()->route('gallery.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request){
        
        $this->gallery = $this->gallery->find($id);
        if (!$this->gallery) {
            $request->session()->flash('error', 'Invalid Gallery information.');
            return redirect()->route('gallery.index');
        }
        $image = $this->gallery->thumbnail;
        $path = $this->gallery->path;
        $other_image = $this->gallery_image->where('gallery_id', $this->gallery->id)->get();
      
        $deleted = $this->gallery->delete();
        if($deleted){
            if (isset($image) && !empty($image)) {
                if (file_exists(public_path().'/uploads/gallery/'.$path.'/'.$image)) {
                    unlink((public_path().'/uploads/gallery/'.$path.'/'.$image)); 
                }
            }
            if(!empty($other_image)){
                foreach($other_image as $image_data){
                    $image_name = $image_data->thumbnail;
                    $delete_image = $this->gallery_image->where('id', $image_data->id)->delete();
                    if(!empty($image_name) && (file_exists(public_path()."/uploads/gallery/".$path."/images/".$image_name))){
                        unlink(public_path()."/uploads/gallery/".$path."/images/".$image_name);
                    }
                }
            }
            File::deleteDirectory(public_path('/uploads/gallery/'.$path.'/images'));
            File::deleteDirectory(public_path('/uploads/gallery/'.$path));
            $request->session()->flash('success', 'Gallery deleted successfully');
        } else {
            $request->session()->flash('error', 'Sorry! Gallery could not be deleted at this moment.');
        }
        return redirect()->route('gallery.index');
    }

    protected function changeGalleryStatus(Request $request){
        $data = $request->all();
        $validation = Validator::make($data, [
            'id'                => 'required|numeric|exists:galleries,id',
            'status'            => 'required|in:Publish,Unpublish',
        ]);


        if ($validation->fails()) {
            foreach ($validation->messages()->getMessages() as $message) {
                $errors[] = $message;
            }    
            return response()->json(['status' => false, 'message' => $errors]);
        }
        $this->gallery = $this->gallery->find($request->id);
        if (!$this->gallery) {
            return response()->json(['status' => false, 'message' => ['Invalid Useful Link information.']]);
        }
        if ($request->status == 'Publish') {
            $data['status'] = 'Unpublish';
        }
        if ($request->status == 'Unpublish') {
            $data['status']= 'Publish';
        }
        $this->gallery->fill($data);
        $success= $this->gallery->save();
        if ($success) {
            $cat_data = $this->gallery->where(['id' => $request->id])->get();
            return response()->json(['status' => true, 'message' => "Status updated Successfully.", 'data' => $cat_data]);
        } else {
            return response()->json(['status' => false, 'message' => ["Sorry There was problem while updating status. Please Try again later."]]);
        }
    }




    public function getSlug($name){
        $slug = \Str::slug($name);
        $find = $this->gallery->where('slug', $slug)->first();
        if($find){
            return false;
        }
        return $slug;
    }



    public function AddRules(){
        return [

            'title'             =>  'required|string',

            'thumbnail'         =>  'required|mimes:jpg,png,jpeg|max:2000',
            'meta_title'        =>  'nullable|string',
            'meta_description'  =>  'nullable|string',
            'keyword'           =>  'nullable|string',
            'meta_keyphrase'    => 'nullable|string',
            'status'            =>  'required|in:Publish,Unpublish',
        ];
    }

    protected function UpdateRules(){
        return [
            'title'             =>  'required|string',
            'thumbnail'         =>  'nullable|image|mimes:jpg,png,jpeg|max:2000',
            'meta_title'        =>  'nullable|string',
            'meta_description'  =>  'nullable|string',
            'keyword'           =>  'nullable|string',
            'meta_keyphrase'    =>  'nullable|string',
            'status'            =>  'required|in:Publish,Unpublish',
        ];
    }

    public function imageProcessing($image,  $image_title){
        $image_name = $image_title . '.' . $image->getClientOriginalExtension();

        // $mainPath = public_path().'/uploads/courses/';
        $mainPath = public_path() . "/uploads/gallery/".$image_title;
        if (!File::exists($mainPath)) {
            File::makeDirectory($mainPath, 0777, true, true);
        }


        $sizePath =$mainPath.'/images';
        if (!File::exists($sizePath)) {
            File::makeDirectory($sizePath, 0777, true, true);
        }
        $useImage = Image::make($image->getRealPath());
        $useImage->save($mainPath . '/' . $image_name);
        return $image_name;
    }
}
