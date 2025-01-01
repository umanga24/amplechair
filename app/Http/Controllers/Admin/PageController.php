<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Page;
use Validator;
use Image;
use File;

class PageController extends Controller{
    protected $page = null;
    public function __construct(Page $page){
    	$this->page = $page;
    }
    public function pageCategory(Request $request, $slug){
    	if ($slug == 'article') {
	    	$pages = $this->page->where(['page_type' => 'article'])->get();
	    	$title = 'article';
    	} else if ($slug == 'other-page'){
            $pages = $this->page->where(['page_type' => 'other'])->orWhere(['page_type' => 'non-article'])->get();
            $title = 'Other';
        } else if($slug == 'legal'){
            $pages = $this->page->where(['page_type' => 'legal'])->get();
            $title = 'legal';
        }

    	return view('admin.page.list', compact('pages', 'title', 'slug'));
    }
    
    public function create(Request $request, $slug){
    	$page_info = null;
    	return view('admin.page.create', compact('page_info', 'slug'));
    }





    public function store(Request $request, $slug){
        $rules  = $this->AddRules($request);
        $request->validate($rules);

        $data = $request->all();
        if ($request->slug) {
            $data['slug'] = $this->getSlug($request->slug);
        } else{
            $data['slug'] = $this->getSlug($request->title);
        }
        $data['page_name'] = $data['slug'];
        $data['keep_alive'] = 'kill';

        if($request->image){
            $image_title =  pathinfo($this->page->thumbnail, PATHINFO_FILENAME);
            if (($image_title == null) || empty($image_title)) {
                $image_title = \Str::slug($this->page->title);
                // dd($image_title);
            }
            $file_name= $this->imageProcessing($request->image, $image_title);

            if($file_name){
                $data['thumbnail'] = $file_name; 
            }
        }
        $data['added_by'] = $request->user()->id;
        if (isset($request->description) && !empty($request->description)) {
            $data['description'] = htmlentities($request->description);
        }
        if (isset($request->summary) && !empty($request->summary)) {
            $data['summary'] = htmlentities($request->summary);
        }
        $this->page->fill($data);
        $success= $this->page->save();
        if($success){
            $request->session()->flash('success', 'Page Information updated Successfully.');
        } else {
            $request->session()->flash('error', 'Error While updating Page Information Data.');
        }
        return redirect()->route('pageCategory',$slug);

    }




    public function EditPage(Request $request, $slug,  $id){
    	$page_info = $this->page->find($id);
    	if (!$this->page) {
            $request->session()->flash('error', 'Invalid Page information.');
            return redirect()->back();
        }
        return view('admin.page.create', compact('page_info', 'slug'));
    }







    public function update(Request $request, $slug, $id){
    	$rules  = $this->UpdateRules($request);
        $request->validate($rules);
    	// dd($request->all());
        $this->page = $this->page->find($id);
        if(!$this->page){
            $request->session()->flash('error', 'Invalid Page information');
            return redirect()->back();
        }

        $data = $request->all();
        if ($request->slug) {
        	$data['slug'] = $this->getSlug($request->slug, $id);
        } else{
        	$data['slug'] = $this->page->slug;
        }

        if($request->image){
            $image_title =  pathinfo($this->page->thumbnail, PATHINFO_FILENAME);
            if (($image_title == null) || empty($image_title)) {
                $image_title = \Str::slug($this->page->title);
                // dd($image_title);
            }
            $file_name= $this->imageProcessing($request->image, $image_title);

            if($file_name){
                $data['thumbnail'] = $file_name; 
            }
        }
                

        $data['added_by'] = $request->user()->id;
        if (isset($request->description) && !empty($request->description)) {
            $data['description'] = htmlentities($request->description);
        }
        if (isset($request->summary) && !empty($request->summary)) {
            $data['summary'] = htmlentities($request->summary);
        }
         
         
        
        $this->page->fill($data);
        $success= $this->page->save();
        
        if($success){
            $request->session()->flash('success', 'Page Information updated Successfully.');
        } else {
            $request->session()->flash('error', 'Error While updating Page Information Data.');
        }
      
        return redirect()->route('pageCategory',$slug);
    }






    protected function orderingPage(Request $request, $slug){
        if ($slug == 'article') {
	    	$pages = $this->page->where(['page_type' => 'article'])->get();
	    	$title = 'article';
    	} else if ($slug == 'other-page'){
            $pages = $this->page->where(['page_type' => 'other'])->orWhere(['page_type' => 'non-article'])->get();
            $title = 'Other';
        } else if($slug == 'legal'){
            $pages = $this->page->where(['page_type' => 'legal'])->get();
            $title = 'legal';
        }
        return view('admin.page.ordering', compact('pages', 'title', 'slug'));
    }




    protected function updatePageOrder(Request $request){
        $this->page = $this->page->find($request->id);
        if (!$this->page) {
            return response()->json(['status' => false, 'message' => ['Page Not found']]);
        }
        $data['order'] = $request->index;
        $this->page->fill($data);
        $success= $this->page->save();
        
        if($success){
            return response()->json(['status' => true, 'message' => 'Ordering successfully Completed.']);
        } else {
            return response()->json(['status' => false, 'message' => ['Sorry!, There was problem while updating ordering.']]);
        }
    }




    public function getSlug($name, $id = null){
        // dd($name);
        $slug = Str_slug($name, '-');
        $find = $this->page->where('slug', $slug)->first();
        // dd($find);
        if($find){
            if (($id != null) && ($id == $find->id)) {
                return $slug;
            }   
            return $slug.'-'.rand(0, 999);
        }
        return $slug;
    }



    public function checkSlug(Request $request){
    	// dd($request->id);
    	$slug = \Str::slug($request->slug);
    	$find = $this->page->where('slug', $request->slug)->first();
    	if($find){
            if ($request->id == $find->id) {
                // return $slug;
                return response()->json(['status' => true, 'message' => "Slug is its own already.", 'slug' => $slug]);
            }   
            return response()->json(['status' => false, 'message' => 'Slug is not unique. Slug should be unique.']);
        }
        return response()->json(['status' => true, 'message' => 'Slug is unique.', 'slug' => $slug]);
    	
    }

     


    public function changePageStatus(Request $request){
    	$data = $request->all();
        $validation = Validator::make($data, [
            'page_id'      => 'required|numeric|exists:pages,id',
            'status'          => 'required|in:Publish,Unpublish',
        ]);

        if ($validation->fails()) {
            foreach ($validation->messages()->getMessages() as $message) {
                $errors[] = $message;
            }    
            return response()->json(['status' => false, 'message' => $errors]);
        }
        $this->page = $this->page->find($request->page_id);
        if (!$this->page) {
            return response()->json(['status' => false, 'message' => ['Invalid page information.']]);
        }
        if ($request->status == 'Publish') {
            $data['status'] = 'Unpublish';
        }
        if ($request->status == 'Unpublish') {
            $data['status']= 'Publish';
        }
        $this->page->fill($data);
        $success= $this->page->save();
        if ($success) {
            $cat_data = $this->page->where(['id' => $request->page_id])->get();
            return response()->json(['status' => true, 'message' => "Page status updated Successfully.", 'data' => $cat_data]);
        } else {
            return response()->json(['status' => false, 'message' => ["Sorry There was problem while updating page status. Please Try again later."]]);
        }
    }

    public function UpdateRules(){
        return [
            'title'             =>  'required|string',
            'slug'				=>	'nullable|string',
            'name'              =>  'required|string',
            'description'		=> 	'nullable|string',
            'image'             =>  'nullable|image|max:5000',
            'meta_title'        =>  'nullable|string',
            'meta_description'  =>  'nullable|string',
            'meta_keyword'      =>  'nullable|string',
            'meta_keyphrase'    =>  'nullable|string',
            'status'            =>  'required|in:Publish,Unpublish',
            'writer'            =>  'nullable|string|max:100', 
            'is_article'        =>  'required|in:yes,no',
            'is_summary'        =>  'required|in:yes,no',
            'show_header'        =>  'required|in:yes,no',
            'show_footer'        =>  'required|in:yes,no',
        
    
        ];
    }
    public function AddRules(){
        return [
            'title'             =>  'required|string',
            'description'		=> 	'nullable|string',
            'slug'				=>	'nullable|string',
            'name'              =>  'required|string',
            'image'             =>  'nullable|max:5000',
            'meta_title'        =>  'nullable|string',
            'meta_description'  =>  'nullable|string',
            'meta_keyword'      =>  'nullable|string',
            'meta_keyphrase'    =>  'nullable|string',
            'status'            =>  'required|in:Publish,Unpublish',
            'writer'            =>  'nullable|string|max:100',
            'is_article'        =>  'required|in:yes,no',
            'is_summary'        =>  'required|in:yes,no',
            'show_header'        =>  'required|in:yes,no',
            'show_footer'        =>  'required|in:yes,no',

        ];
    }
    public function imageProcessing($image,  $image_title){
       $image_name = $image_title.'.'.$image->getClientOriginalExtension();
      
       // $mainPath = public_path().'/uploads/courses/';
       $mainPath = public_path()."/uploads/page";
        if(!File::exists($mainPath)){
            File::makeDirectory($mainPath, 0777, true, true);
        }

        $sizePath = public_path()."/uploads/page/banner";
        if(!File::exists($sizePath)){
            File::makeDirectory($sizePath, 0777, true, true);
        }

       $useImage = Image::make($image->getRealPath());
       $useImage->fit(1350, 510)->save($mainPath.'/'.$image_name);
       
       $mainImage = Image::make($image->getRealPath());
       $mainImage->save($sizePath.'/'.$image_name);
       return $image_name;     
    }
}
