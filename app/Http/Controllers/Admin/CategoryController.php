<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Category;
use Image;
use File;
use Validator;

class CategoryController extends Controller
{
    protected $category = null;
    public function __construct(Category $category)
    {
        $this->category = $category;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allcategories = $this->category->get();
        // dd($categories);
        return view('admin.category.list', compact('allcategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category_info = null;
        $parents_cat = $this->category->where('show_in_menu', 1)->orderBy('title', 'ASC')->get();
        // dd($parents_cat);
        // foreach ($parents_cat as $key => $cat_data) {
        //     $subparent[] = $this->category->where(['parent_id' => $cat_data->id])->get();
        // }
        // dd($subparent);

        return view('admin.category.create', compact('category_info', 'parents_cat'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        // dd($request->all());

        $rules  = $this->AddRules($request);
        $request->validate($rules);
        if (isset($request->is_parent) && ($request->is_parent == 1)) {
            $data['parent_id'] = null;
            $data['is_parent'] = 1;
        }
        $data['is_featured'] = 'no';
        if (isset($request->is_featured) && ($request->is_featured == 'yes')) {
            $data['is_featured'] = 'yes';
        }
        if (!isset($request->is_parent) && ($request->is_parent == 0) && (isset($request->parent_id) && !empty($request->parent_id))) {
            $data['parent_id'] = $request->parent_id;
            $data['is_parent'] = 0;
        }
        // $data['is_parent'] = 1;
        // $data['parent_id'] = null; 
        if (isset($request->show_order) && !empty($request->show_order)) {
            $order_check = $this->category->where(['show_order' => $request->show_order])->get();
            if (count($order_check) > 0) {
                $request->session()->flash('error', 'Selected position for the category display is already exists. Please Change the display order.');
                return redirect()->back();
            }
        }
        if (isset($request->show_in_menu) && ($request->show_in_menu == 1)) {
            $data['show_in_menu'] = 1;
        } else {
            $data['show_in_menu'] = 0;
        }
        if (isset($request->banner_category) && ($request->banner_category == 1)) {
            $data['banner_category'] = "yes";
        } else {
            $data['banner_category'] = "no";
        }

        $data['description'] = htmlentities($request->description);
        $data['slug']       = $this->getSlug($request->title);
        $data['added_by'] = $request->user()->id;
        $data['category_type']  = "kill";

        if ($request->image) {
            $image_title = $this->getSlug($request->title);

            $file_name = $this->imageProcessing($request->image, $image_title);

            if ($file_name) {
                $data['image'] = $file_name;
            }
        }


        if ($request->image1) {
            $image_title = $this->getSlug($request->title);

            $file_name = $this->imageProcessing($request->image1, $image_title);

            if ($file_name) {
                $data['image1'] = $file_name;
            }
        }



        $this->category->fill($data);
        $success = $this->category->save();

        if ($success) {

            $request->session()->flash('success', 'Category added Successfully.');
        } else {
            $request->session()->flash('error', 'Error While adding Category Data.');
        }

        return redirect()->route('category.index');
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
        $category_info = $this->category->find($id);
        if (!$category_info) {
            $request->session()->flash('error', 'Invalid category Id or Category  not found.');
            return redirect()->route('category.index');
        }
        // dd($this->post);
        // $parents_cat= $this->category->getParent();
        $parents_cat = $this->category->where('show_in_menu', 1)->orderBy('title', 'ASC')->get();
        return view('admin.category.create', compact('category_info', 'parents_cat'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());
        $this->category = $this->category->find($id);
        if (!$this->category) {
            $request->session()->flash('error', 'Category data not found.');
            return redirect()->route('category.index');
        }
        // dd($this->category);
        // if (($this->category->is_parent == 1) && ($request->is_parent == 0)) {
        //     $request->session()->flash('error', 'Main category can not be change into sub category.');
        //     return redirect()->route('category.index');
        // }
        $data = $request->all();
        $rules  = $this->AddRules($request);
        $request->validate($rules);
        if (isset($request->is_parent) && ($request->is_parent == 1)) {
            $data['parent_id'] = null;
            $data['is_parent'] = 1;
        }
        $data['is_parent'] = 1;
        if (!isset($request->is_parent) && ($request->is_parent == 0) && (isset($request->parent_id) && !empty($request->parent_id))) {
            $data['parent_id'] = $request->parent_id;
            $data['is_parent'] = 0;
        }
        if (isset($request->show_in_menu) && ($request->show_in_menu == 1)) {
            $data['show_in_menu'] = 1;
        } else {
            $data['show_in_menu'] = 0;
        }
        $data['is_featured'] = 'no';
        if (isset($request->is_featured) && ($request->is_featured == 'yes')) {
            $data['is_featured'] = 'yes';
        }
        if (isset($request->banner_category) && ($request->banner_category == 1)) {
            $data['banner_category'] = 'yes';
        } else {
            $data['banner_category'] = 'no';
        }
        $data['description'] = htmlentities($request->description);

        if (isset($request->show_order)) {
            $order_check = $this->category->where(['show_order' => $request->show_order])->where('show_order', '!=', $this->category->show_order)->get();
            if (count($order_check) > 0) {
                $request->session()->flash('error', 'Selected position for the category display is already exists. Please Change the display order.');
                return redirect()->back();
            }
        }
        // $data['slug']       = $this->getSlug($request->title);
        $data['added_by'] = $request->user()->id;
        // dd($data);
        if ($request->image) {
            $image_title =  pathinfo($this->category->image, PATHINFO_FILENAME);
            if ($image_title == null) {
                $image_title = $this->category->title;
                // dd($image_title);    
            }
            $file_name = $this->imageProcessing($request->image, $image_title);

            if ($file_name) {
                $data['image'] = $file_name;
            }
        }

        //  if($request->image1){
        //     $image_title =  pathinfo($this->category->image1, PATHINFO_FILENAME);
        //     if ($image_title == null) {
        //         $image_title = $this->category->title;
        //         // dd($image_title);    
        //     }
        //     $file_name=$this->imageProcessing($request->image1, $image_title);

        //     if($file_name){
        //         $data['image1'] = $file_name;
        //     }
        // }
        if ($request->image1) {
            $image_title = $this->getSlug($request->title);

            $file_name = $this->imageProcessing($request->image1, $image_title);

            if ($file_name) {
                $data['image1'] = $file_name;
            }
        }

        $this->category->fill($data);
        $success = $this->category->save();

        if ($success) {

            $request->session()->flash('success', 'Category udpated Successfully.');
        } else {
            $request->session()->flash('error', 'Error While updating Category Data.');
        }

        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $category_id = $this->category->find($id);
        if (!$category_id) {
            $request->session()->flash('error', 'Category data not found.');
            return redirect()->route('category.index');
        }
        $image = $category_id->image;
        $child_cats = $this->category->getChild($id);
        $del = $category_id->delete();
        if ($del) {
            $ids = array();
            foreach ($child_cats as $children) {
                $ids[] = $children->id;
            }
            $this->category->shiftChild($ids);

            if (isset($image) && !empty($image) && file_exists(public_path() . '/uploads/category/banner/' . $image)) {
                unlink((public_path() . '/uploads/category/banner/' . $image));
            }
            if (isset($image) && !empty($image) && file_exists(public_path() . '/uploads/category/thumbnail/' . $image)) {
                unlink((public_path() . '/uploads/category/thumbnail/' . $image));
            }
            if (isset($image) && !empty($image) && file_exists(public_path() . '/uploads/category/list/' . $image)) {
                unlink((public_path() . '/uploads/category/list/' . $image));
            }
            $request->session()->flash('success', 'Category deleted successfully');
        } else {
            $request->session()->flash('error', 'Sorry! Category could not be deleted at this moment.');
        }
        return redirect()->route('category.index');
    }
    public function CategoryOrderManagement(Request $request)
    {
        $allcategories = $this->category->where(['show_in_menu' => 1])->get();
        // dd($categories);
        return view('admin.category.ordering', compact('allcategories'));
    }
    public function getSubCatByCatId($cat_id, Request $request)
    {
        $parent = $this->category->find($cat_id);
        if (!$parent) {
            return response()->json(['status' => false, 'message' => ['Invalid Category id or category not found.']]);
        }
        $child_cat = $this->category->where(['is_parent' => 0, 'parent_id' => $cat_id])->get();
        // dd($child_parent);
        if (count($child_cat) > 0) {
            return response()->json([
                'status' => true,
                'html' => view('admin.category.child-category', compact('child_cat'))->render(),
                'message' => "Sub category  list found.",
            ]);
        } else {
            return response()->json(['status' => false, 'message' => ['Child parent not found.']]);
        }
    }

    public function changeCategoryStatus(Request $request)
    {
        $data = $request->all();
        $validation = Validator::make($data, [
            'category_id'      => 'required|numeric|exists:categories,id',
            'status'          => 'required|in:Publish,Unpublish',
        ]);


        if ($validation->fails()) {
            foreach ($validation->messages()->getMessages() as $message) {
                $errors[] = $message;
            }
            return response()->json(['status' => false, 'message' => $errors]);
        }
        $this->category = $this->category->find($request->category_id);
        if (!$this->category) {
            return response()->json(['status' => false, 'message' => ['Invalid Category id or category not found.']]);
        }
        if ($request->status == 'Publish') {
            $data['status'] = 'Unpublish';
        }
        if ($request->status == 'Unpublish') {
            $data['status'] = 'Publish';
        }
        $this->category->fill($data);
        $success = $this->category->save();
        if ($success) {
            $cat_data = $this->category->where(['id' => $request->category_id])->get();
            return response()->json(['status' => true, 'message' => "Category updated Successfully.", 'data' => $cat_data]);
        } else {
            return response()->json(['status' => false, 'message' => ["Sorry There was problem while updating category status. Please Try again later."]]);
        }
    }

    public function getChildCategoryByCatId(Request $request)
    {
        $cate_info = $this->category->find($request->cat_id);
        if (!$cate_info) {
            // if not a valid category info
            return response()->json(['status' => false, 'message' => ["Invalid Category."], 'type' => null]);
        }
        $child_cat = $this->category->getChild($request->cat_id);

        if (count($child_cat) > 0) {
            return response()->json([
                'status' => true,
                'html' => view('admin.category.child-category', compact('child_cat'))->render(),
                'message' => "Child Category found."
            ]);
        } else {

            return response()->json(['status' => false, 'message' => ["Child category not found."], 'type'  => "childCat"]);
        }
    }


    public function getSlug($name)
    {
        $slug = \Str::slug($name);
        $find = $this->category->where('slug', $slug)->first();
        if ($find) {
            return $slug . "-" . rand(0, 999);
        }
        return $slug;
    }

    public function AddRules()
    {
        return [
            'title'             =>  'required|string',
            'summary'           =>  'nullable|string|max:500',
            'is_parent'         =>  'nullable|numeric|in:0,1',
            'parent_id'         =>  'nullable|numeric|exists:categories,id',
            'show_in_menu'      =>  'nullable|numeric|in:0,1',
            'status'            =>  'required|in:Publish,Unpublish',
            'image'             =>  'nullable|max:5000',
            'image1'            =>  'nullable|max:5000',
        ];
    }

    public function imageProcessing($image,  $image_title)
    {
        $image_ext = $image->getClientOriginalExtension();
        $image_name = $image_title . '.' . $image_ext;


        // $original_path = public_path().'/uploads/courses/';
        $original_path = public_path() . "/uploads/category/main";
        if (!File::exists($original_path)) {
            File::makeDirectory($original_path, 0777, true, true);
        }

        $resized_path = public_path() . "/uploads/category/thumbnail";
        if (!File::exists($resized_path)) {
            File::makeDirectory($resized_path, 0777, true, true);
        }
        $list_path = public_path() . "/uploads/category/banner";
        if (!File::exists($list_path)) {
            File::makeDirectory($list_path, 0777, true, true);
        }
        $keep_original = Image::make($image->getRealPath());
        $keep_original->save($original_path . '/' . $image_name);


        // $useImage = Image::make($image->getRealPath());
        // $useImage->save($resized_path . '/' . $image_name);
        //$useImage->save($resized_path . '/' . $image_name);

        $listImage = Image::make($image->getRealPath());
        $listImage->save($list_path . '/' . $image_name);
        return $image_name;
    }
}
