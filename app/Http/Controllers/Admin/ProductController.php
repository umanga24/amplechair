<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Product;
use App\Models\Admin\Category;
use App\Models\Admin\ProductImage;
use Image;
use File;
use Validator;

class ProductController extends Controller
{
    protected $product = null;
    protected $category = null;
    protected $product_image = null;
    public function __construct(Product $product, Category $_category, ProductImage $product_image)
    {
        $this->product = $product;
        $this->category = $_category;
        $this->product_image = $product_image;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = $this->product = $this->product->ListAllProducts();
        return view('admin.product.list', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $grand_child_cat = null;
        $child_cat = null;
        $product_info = null;
        $category_info = $this->category->where(['status' => 'Publish', 'is_parent' => 1])->where('slug', '!=', 'products')->orderBy('title', 'ASC')->get();
        return view('admin.product.create', compact('product_info', 'category_info', 'grand_child_cat', 'child_cat'));
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
        //dd($data);
        // $data->description=$request->description;

        $data['is_featured'] = 0;
        if (isset($request->is_featured) && ($request->is_featured == 1)) {
            $data['is_featured'] = 1;
        }

        //   $data['description'] = 0;
        // if (isset($request->description) && ($request->description == 1)) {
        //     $data['description'] = 1;
        // }

        $data['sale'] = 0;
        if (isset($request->sale) && ($request->sale == 1)) {
            $data['sale'] = 1;
        }
        $data['is_other'] = 0;
        if (isset($request->is_other) && ($request->is_other == 1)) {
            $data['is_other'] = 1;
        }
        $rules  = $this->AddRules($request);
        $msg = ['dimensions' => "The Slider Image size should be 765px X 1020px."];
        $request->validate($rules, $msg);

        $data['added_by'] = $request->user()->id;
        $data['slug']       = $this->getSlug($request->description);

        $data['slug']       = $this->getSlug($request->title);


        $data['path'] = $data['slug'] . '-' . date('Ymd-his');



        if ($request->image) {
            $file_name = $this->imageProcessing($request->image, $data['path']);
            if ($file_name) {
                $data['image'] = $file_name;
            }
        }



    

        if (isset($request->cat_id)) {
            $data['search'] = $request->title;

            $grand_child_info = $this->category->find($request->cat_id);
            $cat_info = null;
            $child_cat_info = null;
            $data['search'] = $request->title . " " . $grand_child_info->title;

            if ($grand_child_info->is_parent == 0) {
                $child_cat_info = $this->category->find($grand_child_info->parent_id);

                $data['search'] = $request->title . " " . $grand_child_info->title . " " . $child_cat_info->title;

                if ($child_cat_info->is_parent == 0) {
                    $cat_info = $this->category->find($child_cat_info->parent_id);
                    $data['search'] = $request->title . " " . $grand_child_info->title . " " . $child_cat_info->title . $cat_info->title;
                }
            }
            $data['search'] = \Str::slug($data['search']);
        }

        if (isset($request->cat_id)) {
            $data['search'] = $request->description;

            $grand_child_info = $this->category->find($request->cat_id);
            $cat_info = null;
            $child_cat_info = null;
            $data['search'] = $request->description . " " . $grand_child_info->description;

            if ($grand_child_info->is_parent == 0) {
                $child_cat_info = $this->category->find($grand_child_info->parent_id);

                $data['search'] = $request->description . " " . $grand_child_info->description . " " . $child_cat_info->description;

                if ($child_cat_info->is_parent == 0) {
                    $cat_info = $this->category->find($child_cat_info->parent_id);
                    $data['search'] = $request->description . " " . $grand_child_info->description . " " . $child_cat_info->description . $cat_info->description;
                }
            }
            $data['search'] = \Str::slug($data['search']);
        }




        $this->product->fill($data);
        $success = $this->product->save();
        if ($success) {
            $request->session()->flash('success', 'Product added Successfully.');
        } else {
            $request->session()->flash('error', 'Error While adding product Data.');
        }
        return redirect()->route('product.index');
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
    public function edit($id, Request $request)
    {
        // dd($id);
        $product_info = $this->product->find($id);
        if (!$product_info) {
            $request->session()->flash('error', 'Product not found.');
            return redirect()->route('product.index');
        }
        $grand_child_cat = null;
        $child_cat = null;


        $cat_info = $this->category->where(['id' => $product_info->cat_id])->get();
        if (isset($cat_info) && (($cat_info[0]->is_parent == 0) || ($cat_info[0]->is_parent == null))) {
            $child_cat = $cat_info;
            $new_cat_info  = $this->category->where(['id' => $cat_info[0]->parent_id])->get();
            $cat_info = $new_cat_info;
            if (isset($new_cat_info) && (($new_cat_info[0]->is_parent == 0) || ($new_cat_info[0]->is_parent ==  null))) {
                $grand_child_cat  = $child_cat;
                $child_cat = $new_cat_info;
                $final_cat_info = $this->category->where(['id' => $new_cat_info[0]->parent_id])->get();
                $cat_info = $final_cat_info;
            }
        }
        // dd($cat_info);
        // dd($grand_child_cat);



        $category_info = $this->category->where(['status' => 'Publish', 'is_parent' => 1])->where('slug', '!=', 'products')->orderBy('title', 'ASC')->get();


        $sub_cat_info = $this->category->where(['status' => 'Publish', 'is_parent' => 0, 'parent_id' => $cat_info[0]->id])->orderBy('title', 'ASC')->get();
        // dd($sub_cat_info);
        $grand_cat_info = null;
        if ($grand_child_cat != null) {
            $grand_cat_info  = $this->category->where(['status' => 'Publish', 'is_parent' => 0, 'parent_id' => $child_cat[0]->id])->orderBy('title', 'ASC')->get();
        }
        // dd($grand_cat_info);

        return view('admin.product.create', compact(
            'product_info',
            'category_info',
            'sub_cat_info',
            'grand_cat_info',
            'cat_info',
            'child_cat',
            'grand_child_cat'
        ));
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
        $this->product = $this->product->find($id);

        if (!$this->product) {
            $request->session()->flash('error', 'Invalid product information.');
            return redirect()->route('product.index');
        }
        $data = $request->all();


        // dd($data);
        $data['is_featured'] = $this->product->is_featured;

        if (isset($request->is_featured) && ($request->is_featured == 1)) {
            $data['is_featured'] = 1;
        }
        // $data['description'] = $this->product->description;

        // if (isset($request->description) && ($request->description == 1)) {
        //     $data['description'] = 1;
        // }
        $data['sale'] = 0;
        if (isset($request->sale) && ($request->sale == 1)) {
            $data['sale'] = 1;
        }
        $data['is_other'] = 0;
        if (isset($request->is_other) && ($request->is_other == 1)) {


            $data['is_other'] = 1;
        }

        // $data['description'] = 0;
        // if (isset($request->description) && ($request->description == 1)) {
        //     $data['description'] = 1;
        // }


        $rules  = $this->updateRules($request);
        $msg = ['dimensions' => "The Slider Image size should be 765px X 1020px."];
        $request->validate($rules, $msg);

        $data['added_by'] = $request->user()->id;
        // dd($data);

        if ($request->image) {

            $file_name = $this->imageProcessing($request->image, $this->product->path);

            if ($file_name) {
                $data['image'] = $file_name;
            }
        }






        if (isset($request->cat_id)) {
            $data['search'] = $request->title;
            $grand_child_info = $this->category->find($request->cat_id);
            $cat_info = null;
            $child_cat_info = null;

            $data['search'] = $request->title . " " . $grand_child_info->title;
            if ($grand_child_info->is_parent == 0) {
                $child_cat_info = $this->category->find($grand_child_info->parent_id);

                $data['search'] = $request->title . " " . $grand_child_info->title . " " . $child_cat_info->title;
                if ($child_cat_info->is_parent == 0) {
                    $cat_info = $this->category->find($child_cat_info->parent_id);
                    $data['search'] = $request->title . " " . $grand_child_info->title . " " . $child_cat_info->title . $cat_info->title;
                }
            }
            $data['search'] = \Str::slug($data['search']);
        }
        if (isset($request->cat_id)) {
            $data['search'] = $request->description;
            $grand_child_info = $this->category->find($request->cat_id);
            $cat_info = null;
            $child_cat_info = null;

            $data['search'] = $request->description . " " . $grand_child_info->description;
            if ($grand_child_info->is_parent == 0) {
                $child_cat_info = $this->category->find($grand_child_info->parent_id);

                $data['search'] = $request->description . " " . $grand_child_info->description . " " . $child_cat_info->description;
                if ($child_cat_info->is_parent == 0) {
                    $cat_info = $this->category->find($child_cat_info->parent_id);
                    $data['search'] = $request->description . " " . $grand_child_info->description . " " . $child_cat_info->description . $cat_info->description;
                }
            }
            $data['search'] = \Str::slug($data['search']);
        }


        $this->product->fill($data);
        $success = $this->product->save();
        if ($success) {
            $request->session()->flash('success', 'Product updated Successfully.');
        } else {
            $request->session()->flash('error', 'Error While updating product Data.');
        }
        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        // dd($id);
        $this->product = $this->product->find($id);
        if (!$this->product) {
            $request->session()->flash('error', 'Invalid product information.');
            return redirect()->route('product.index');
        }
        $image = $this->product->image;
        $path = $this->product->path;

        $other_image = $this->product_image->where('product_id', $this->product->id)->get();

        // dd($other_image);
        $deleted = $this->product->delete();
        if ($deleted) {
            if (isset($image) && !empty($image)) {
                if (file_exists(public_path() . '/uploads/product/' . $path . '/banner/' . $image)) {
                    unlink((public_path() . '/uploads/product/' . $path . '/banner/' . $image));
                }
                if (file_exists(public_path() . '/uploads/product/' . $path . '/main/' . $image)) {
                    unlink((public_path() . '/uploads/product/' . $path . '/main/' . $image));
                }
                if (file_exists(public_path() . '/uploads/product/' . $path . '/thumbnail/' . $image)) {
                    unlink((public_path() . '/uploads/product/' . $path . '/thumbnail/' . $image));
                }
            }
            if (!empty($other_image)) {
                foreach ($other_image as $product_img) {
                    $image_name = $product_img->images;
                    $delete_image = $this->product_image->where('id', $product_img->id)->delete();
                    if (!empty($image_name) && (file_exists(public_path() . "/uploads/product/" . $path . "/product-images/" . $image_name))) {
                        unlink(public_path() . "/uploads/product/" . $path . "/product-images/" . $image_name);
                    }
                }
            }
            $request->session()->flash('success', 'Product deleted successfully');
        } else {
            $request->session()->flash('error', 'Sorry! Product could not be deleted at this moment.');
        }
        return redirect()->route('product.index');
    }
    public function editProduct($id, Request $request)
    {
        $product_info = $this->product->find($id);

        if (!$product_info) {
            $request->session()->flash('error', 'Invalid Product Information.');
        }
        return view('admin.product.update-product-detail', compact('product_info'));
    }






    public function updateProduct($id, Request $request)
    {
        // dd($request);
        $this->product = $this->product->find($id);
        if (!$this->product) {
            $request->session()->flash('error', 'Invalid Product Information.');
            return redirect()->route('product.index');
        }
        // $data = $request->all();
        // dd($request->image);
        $rules  = $this->updateDetailRule($request);
        $request->validate($rules);

        // $message=['image.*.dimensions'=>'The  :attribute size should be 765px width and 1020px height.'];
        // $this->validate($request,[
        //     'image.*' =>  'nullable|image|mimes:jpg,jpeg,png|max:2000|dimensions:width=765,height=1020',
        // ],$message);


        $valid = Validator::make($request->all(), [
            'image.*' =>  'nullable|image|mimes:jpg,jpeg,png|max:2000|dimensions:width=765,height=1020',
        ]);
        if ($valid->fails()) {
            $i = 0;
            // 'required' => 'The :attribute field is required.'
            foreach ($valid->messages()->getMessages() as  $key => $message) {
                $message = 'The  image on ' . $key . ' size should be 765px widthd and 1020px height.';
                $i++;
                $errorimage[] = $message;
            }
            // dd($errorimage);

            // $request->session()->flash('warning', $errorimage);
            return redirect()->back()->with('image_warning', $errorimage);
        }




        $data['added_by'] = $request->user()->id;
        $data['description'] = htmlentities($request->description);
        $data['highlight'] = htmlentities($request->highlight);
        $data['summary'] = htmlentities($request->summary);

        $this->product->fill($data);
        $success = $this->product->save();
        //    dd($this->product);
        $db_image = count($this->product->other_image);

        if ($success) {
            if ($request->image) {
                $img_count = count($request->image);
                if (($img_count + $db_image) > 8) {
                    $request->session()->flash('error', 'Sorry, You have already uploaded ' . $db_image . ' images. You can upload images upto 6 Nos for a product.');
                    return redirect()->route('edit-product', $id);
                }
                $temp = [];
                foreach ($request->image as $key => $other_image) {
                    $image_title = $this->product->slug . "-image-" . $key . rand(0, 10);
                    // dd($image_title);
                    $file_name = $this->OtherImage($other_image, $image_title);
                    if ($file_name) {
                        $temp[] = array('product_id' => $this->product->id, 'images' => $file_name);
                    }
                }
                if (!empty($temp)) {
                    $this->product_image->insert($temp);
                }
            }
            $request->session()->flash('success', 'Product detail updated Successfully.');
        } else {
            $request->session()->flash('error', 'Product detail could not be updated at this moment.');
        }
        return redirect()->route('product.index');
    }






    public function updateProductImage(Request $request, $id)
    {
        $data = [];

        $data['image'] = $request->file('file');
        $data['product_id']  = $id;
        $validation = Validator::make($data, [
            'product_id'      => 'required|numeric|exists:products,id',
            'image'             =>  'required|image|mimes:jpg,jpeg,gif|max:12000|',
        ]);
        if ($validation->fails()) {
            foreach ($validation->messages()->getMessages() as $message) {
                $errors[] = $message;
            }
            return response()->json(['status' => false, 'message' => $errors]);
        }

        $data['added_by'] = $request->user()->id;
        // dd($data['image']);
        $this->product = $this->product->find($id);


        if ($data['image']) {
            // $image_title = $this->getSlug($request->title);
            $image_title = $this->product->path . '-' . date('Ymdhis') . '-' . rand(5001, 9999);
            $file_name = $this->OtherImage($data['image'], $image_title, $this->product->path);
            if ($file_name) {
                $data['images'] = $file_name;
            }
        }
        // dd($file_name);


        $this->product_image->fill($data);
        $success = $this->product_image->save();
        if ($success) {
            return response()->json(['status' => true, 'message' => 'Image Uploaded Successfully.']);
            $request->session()->flash('success', ' Images added Successfully.');
        } else {
            $request->session()->flash('error', 'Error While adding Images.');
        }
    }


    public function getProductImageByProductId(Request $request)
    {
        $product_info = $this->product->find($request->id);

        if (!$product_info) {
            return response()->json(['status' => false, 'message' => 'Product Not found. Please Reload the page']);
        }
        if ($product_info) {
            return response()->json(['status' => true, 'message' => 'Successfully data found.', 'data' => view('admin.product.replace-image', compact('product_info'))->render()]);
        }
    }

    public function deleteImageById(Request $request)
    {
        //    dd($request);
        $image_data  = $this->product_image->find($request->id);

        if (!$image_data) {
            return response()->json(['status' => false, 'message' => ["Invalid Image information."]]);
        }
        $image = $image_data->images;
        $del = $image_data->delete();
        if ($del) {
            if (isset($image) && !empty($image) && file_exists(public_path() . '/uploads/product/' . $request->path . '/product-images/' . $image)) {
                unlink((public_path() . '/uploads/product/' . $request->path . '/product-images/' . $image));
            }
            return response()->json([
                'status' => true,
                'message' => "Product image deleted successfully."
            ]);
        } else {
            return response()->json(['status' => false, 'message' => ["Sorry! Product Image could not be deleted at this time please reload the page page and try again."]]);
        }
    }



    public function AddRules()
    {
        return [
            'title'             => 'required|string',
            'description'       => 'required|string',
            'price'             => 'nullable|numeric',
            'discount'          => 'nullable|numeric|max:100',
            'brand'             => 'nullable|string|max:50',
            'model'             => 'nullable|string|max:50',

            'cat_id'            => 'required|numeric|exists:categories,id',
            'meta_title'        => 'nullable|string|max:200',
            'meta_description'  => 'nullable|string',
            'keyword'           => 'nullable|string|max:200',
            'meta_keyphrase'    => 'nullable|string|max:200',
            'status'            => 'required|in:Publish,Unpublish',
            // 'image'             =>  'required|image|mimes:jpg,jpeg,png|max:3000',
            // 'image' =>  'required|image|mimes:jpg,jpeg,png|max:3000|dimensions:width=765,height=1020',
        ];
    }
    public function updateRules()
    {
        return [
            'title'             => 'required|string',
            'description'       => 'required|string',
            'price'             => 'nullable|numeric',
            'discount'          => 'nullable|numeric|max:100',
            'brand'             => 'nullable|string|max:50',
            'model'             => 'nullable|string|max:50',

            'cat_id'            => 'required|numeric|exists:categories,id',
            'meta_title'        => 'nullable|string|max:200',
            'meta_description'  => 'nullable|string',
            'keyword'           => 'nullable|string|max:200',
            'meta_keyphrase'    => 'nullable|string|max:200',
            'status'            => 'required|in:Publish,Unpublish',
            // 'image'             =>  'nullable|image|mimes:jpg,jpeg,png|max:3000',
            // 'image' =>  'nullable|image|mimes:jpg,jpeg,png|max:3000|dimensions:width=765,height=1020',
        ];
    }
    public function updateDetailRule()
    {
        return [
            'description' => 'nullable|string',
            'highlight' => 'nullable|string',
            'summary' => 'nullable|string',

        ];
    }

    public function getSlug($name)
    {
        $slug = \Str::slug($name);
        $find = $this->product->where('slug', $slug)->first();
        if ($find) {
            return $slug . rand(0, 999);
        }
        return $slug;
    }


    public function imageProcessing($image,  $image_title)
    {
        $image_ext = $image->getClientOriginalExtension();
    $image_name = $image_title . '.' . $image_ext;

    // Define paths
    $main_path = public_path() . "/uploads/product/" . $image_title;
    $original_path = $main_path . '/main';
    $thumb_path = $main_path . '/thumbnail';
    $list_path = $main_path . '/banner';

    // Create directories if they don't exist
    foreach ([$main_path, $original_path, $thumb_path, $list_path] as $path) {
        if (!File::exists($path)) {
            File::makeDirectory($path, 0777, true, true);
        }
    }

    // Save the original image
    $keep_original = Image::make($image->getRealPath());
    $keep_original->save($original_path . '/' . $image_name);

    // Create thumbnail
    $thumbImage = Image::make($image->getRealPath());
    // $thumbImage->resize(340, null, function ($constraint) {
    //     $constraint->aspectRatio();
    //     $constraint->upsize();
    // });
    $thumbImage->save($thumb_path . '/' . $image_name);

    // Create banner
    $listImage = Image::make($image->getRealPath());
    $listImage->fit(800, 500, function ($constraint) {
        $constraint->upsize();
    });
    $listImage->save($list_path . '/' . $image_name);

    return $image_name;
    }







    public function OtherImage($image,  $image_title, $path)
    {
        $image_name = $image_title . '.' . $image->getClientOriginalExtension();
        $mainPath = public_path() . "/uploads/product/" . $path . '/product-images';
        if (!File::exists($mainPath)) {
            File::makeDirectory($mainPath, 0777, true, true);
        }

        $useImage = Image::make($image->getRealPath());
        $useImage->save($mainPath . '/' . $image_name);
        // dd($image->getSize());
        if (($image->getSize() > 50000) && ($image->getClientOriginalExtension() != 'gif')) {
            $this->resize_image($image_name, $mainPath, 1000, $image->getClientOriginalExtension());
        }
        return $image_name;
    }

    public function resize_image($filename, $upload_path = null, $max_resolution, $extension)
    {
        $image_path = $upload_path . '/' . $filename;
        if (strtolower($extension) === "png") {
            $original_image  = imagecreatefrompng($image_path);
        }
        if ((strtolower($extension) === "jpg") || (strtolower($extension) === "jpeg")) {
            $original_image  = imagecreatefromjpeg($image_path);
        }
        $image_detail = getimagesize($image_path);
        // dd($image_detail);

        $original_width = imagesx($original_image);
        $original_height = imagesy($original_image);

        $ratio  = $max_resolution / $original_width;
        $new_width = $max_resolution;
        $new_height = $original_height * $ratio;
        // if that didn't work
        if ($new_height > $max_resolution) {
            $ratio = $max_resolution / $original_height;
            $new_height = $max_resolution;
            $new_width = $original_width * $ratio;
        }
        if ($original_image) {
            $new_image = imagecreatetruecolor($new_width, $new_height);
            imagecopyresampled($new_image, $original_image, 0, 0, 0, 0, $new_width, $new_height, $original_width, $original_height);
            return imagejpeg($new_image, $image_path, 90);
        }
    }
}
