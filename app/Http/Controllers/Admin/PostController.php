<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Post;
use Image;
use File;
use Validator;
class PostController extends Controller{
    protected $post = null;
    public function __construct(Post $_post){
        $this->post = $_post;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $post_info = $this->post->get();
     
        return view('admin.blog.list')
        ->with('post_info', $post_info);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $post_info = null;
        return view('admin.blog.create')
        ->with('post_info', $post_info);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        // dd($request->all());
        date_default_timezone_set("Asia/Kathmandu");


        $rules  = $this->AddRules($request);
        $request->validate($rules);
        $data = $request->all();
        $data['page_title'] = $data['slug'];
        $data['name'] = $data['title'];
        if ($request->slug) {
            $data['slug'] = $this->getSlug($request->slug);
        } else{
            $data['slug'] = $this->getSlug($request->title);
        }

        if($request->thumbnail){
            $file_name=$this->imageProcessing($request->thumbnail, $data['slug']);

            if($file_name){
                $data['thumbnail'] = $file_name; 
            }
        }
        $data['added_by'] = $request->user()->id;
        
        $data['description'] = htmlentities($request->description);
        
         
        
        $this->post->fill($data);
        $success= $this->post->save();
        
        if($success){
            
            $request->session()->flash('success', 'Blog added Successfully.');
        } else {
            $request->session()->flash('error', 'Error While adding Blog Data.');
        }
      
        return redirect()->route('post.index');
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
        // dd($id);
        $this->post = $this->post->find($id);
        if (!$this->post) {
            $request->session()->flash('error', 'Invalid Post Id or Post  not found.');
            return redirect()->route('post.index');
        }
          // dd($this->post);
        return view('admin.blog.create')
        ->with('post_info', $this->post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
         
        $rules  = $this->UpdateRules($request);
        $request->validate($rules);
        $this->post = $this->post->find($id);
        if(!$this->post){
            $request->session()->flash('error', 'Invalid Blog Id');
            return redirect()->route('post.index');
        }

        $data = $request->all();

        if($request->thumbnail){
            $image_title =  pathinfo($this->post->thumbnail, PATHINFO_FILENAME);
            if(($image_title== null) || empty($image_title)){
                $image_title = \Str::slug($request->title);
            }
            $file_name=$this->imageProcessing($request->thumbnail, $image_title);

            if($file_name){
                $data['thumbnail'] = $file_name; 
            }
        }
                
        $data['added_by'] = $request->user()->id;
        $data['description'] = htmlentities($request->description);
        // dd($data);
         
        
        $this->post->fill($data);
        $success= $this->post->save();
        
        if($success){
            
            $request->session()->flash('success', 'Blog updated Successfully.');
        } else {
            $request->session()->flash('error', 'Error While updating Blog Data.');
        }
      
        return redirect()->route('post.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request){
        $this->post= $this->post->find($id);
   
        if(!$this->post){
            $request->session()->flash('error', 'Post not found.');
            return redirect()->route('post.index');
        }
        $image = $this->post->thumbnail;
        
     
        $del= $this->post->delete();
        if($del){
            if(isset($image) && !empty($image) && file_exists(public_path().'/uploads/blog/'.$image)){
                unlink((public_path().'/uploads/blog/'.$image));
            }
            if(isset($image) && !empty($image) && file_exists(public_path().'/uploads/blog/banner/'.$image)){
                unlink((public_path().'/uploads/blog/banner/'.$image));
            }
            if(isset($image) && !empty($image) && file_exists(public_path().'/uploads/blog/thumbnail/'.$image)){
                unlink((public_path().'/uploads/blog/thumbnail/'.$image));
            }
            $request->session()->flash('success', 'post deleted successfully');
        } else {
            $request->session()->flash('error', 'Sorry! post could not be deleted at this moment.');
        }
        return redirect()->route('post.index');
    }

    public function AddRules(){
        return [
            'published_date'    =>  'nullable|date_format:Y-m-d',
            'title'             =>  'required|string',
            'summary'           =>  'required|string',
            'description'       =>  'nullable|string',
            'thumbnail'         =>  'required|max:5000',
            'youtube_link'      =>  'nullable|url',
            'meta_title'        =>  'nullable|string',
            'meta_description'  =>  'nullable|string',
            'keyword'           =>  'nullable|string',
            'status'            =>  'required|in:Publish,Unpublish',
            'meta_keyphrase'    => 'nullable|string',              
        ];
    }

    public function changePostStatus(Request $request){
        $data = $request->all();
        $validation = Validator::make($data, [
            'post_id'      => 'required|numeric|exists:posts,id',
            'status'          => 'required|in:Publish,Unpublish',
        ]);


        if ($validation->fails()) {
            foreach ($validation->messages()->getMessages() as $message) {
                $errors[] = $message;
            }    
            return response()->json(['status' => false, 'message' => $errors]);
        }
        $this->post = $this->post->find($request->post_id);
        if (!$this->post) {
            return response()->json(['status' => false, 'message' => ['Invalid blog information.']]);
        }
        if ($request->status == 'Publish') {
            $data['status'] = 'Unpublish';
        }
        if ($request->status == 'Unpublish') {
            $data['status']= 'Publish';
        }
        $this->post->fill($data);
        $success= $this->post->save();
        if ($success) {
            $cat_data = $this->post->where(['id' => $request->post_id])->get();
            return response()->json(['status' => true, 'message' => "Blog status updated Successfully.", 'data' => $cat_data]);
        } else {
            return response()->json(['status' => false, 'message' => ["Sorry There was problem while updating blog status. Please Try again later."]]);
        }
    }

    protected function checkBlogSlug(Request $request){
        // dd($request->id);
    	$slug = \Str::slug($request->slug);
    	$find = $this->post->where('slug', $request->slug)->first();
    	if($find){
            if ($request->id == $find->id) {
                // return $slug;
                return response()->json(['status' => true, 'message' => "Slug is its own already.", 'slug' => $slug]);
            }   
            return response()->json(['status' => false, 'message' => 'Slug is not unique. Slug should be unique.']);
        }
        return response()->json(['status' => true, 'message' => 'Slug is unique.', 'slug' => $slug]);
    	
    }

    protected function updatePostOrder(Request $request){
        $this->post = $this->post->find($request->id);
        if (!$this->post) {
            return response()->json(['status' => false, 'message' => ['Data Not found']]);
        }
        $data['order'] = $request->index;
        $this->post->fill($data);
        $success= $this->post->save();
        
        if($success){
            return response()->json(['status' => true, 'message' => 'Ordering successfully Completed.']);
        } else {
            return response()->json(['status' => false, 'message' => ['Sorry!, There was problem while updating ordering.']]);
        }
    }
    public function UpdateRules(){
        return [
            'published_date'    =>  'nullable|date_format:Y-m-d',
            'title'             =>  'required|string',
            'summary'           =>  'required|string',
            'description'       =>  'nullable|string',
            'thumbnail'         =>  'sometimes|image|max:5000',
            'youtube_link'      =>  'nullable|url',
            'meta_title'        =>  'nullable|string',
            'meta_description'  =>  'nullable|string',
            'keyword'           =>  'nullable|string',
            'status'            =>  'required|in:Publish,Unpublish',
            'meta_keyphrase'    => 'nullable|string',             
        ];
    }
    public function getSlug($name){
        $slug = \Str::slug($name);
        $find = $this->post->where('slug', $slug)->first();
        if($find){
            return false;
        }
        return $slug;
    }
    public function imageProcessing($image,  $image_title){
       $image_name = $image_title.'.'.$image->getClientOriginalExtension();
      
       // $mainPath = public_path().'/uploads/courses/';
       $mainPath = public_path()."/uploads/blog";
        if(!File::exists($mainPath)){
            File::makeDirectory($mainPath, 0777, true, true);
        }

        $sizePath = public_path()."/uploads/blog/banner";
        if(!File::exists($sizePath)){
            File::makeDirectory($sizePath, 0777, true, true);
        }
        $thumbPath = public_path()."/uploads/blog/thumbnail";
        if (!File::exists($thumbPath)) {
            File::makeDirectory($thumbPath, 0777, true, true);
        }

        $thumbImage = Image::make($image->getRealPath());
        $thumbImage->fit(400, 250)->save($thumbPath.'/'.$image_name);

        $useImage = Image::make($image->getRealPath());
        $useImage->fit(800, 500)->save($mainPath.'/'.$image_name);

        $mainImage = Image::make($image->getRealPath());
        $mainImage->save($sizePath.'/'.$image_name);
        return $image_name;     
    }
}
