<?php

namespace App\Http\Controllers\Front;

use Illuminate\Support\Str;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Category;
use App\Models\Admin\Gallery;
use App\Models\Admin\Order;
use App\Models\Admin\Page;
use App\Models\Admin\Post;
use App\Models\Admin\Product;
use App\Models\Admin\Site;
use App\Models\Admin\Slider;
use App\Models\Banner;
use App\Models\Career;
use App\Models\Client;
use App\Models\Document;
use App\Models\Front\Contact;
use App\Models\Map;
use App\Models\Media;
use App\Models\Process;
use App\Models\Quote;
use App\Models\Recognization;
use App\Models\SatyStory;
use App\Models\Sustain;
use App\Models\Team;
use Validator;
use Mail;
use Cookie;

class FrontEndController extends Controller
{
    private $slider = null;
    private $page = null;
    private $website_detail = null;
    private $post = null;
    private $category  = null;
    private $team  = null;
    private $product = null;
    private $contact = null;
    private $career = null;
    private $orders  = null;
    private $gallery = null;
    private $quote = null;
    protected $mail_address = 'info@gmail.com';
    public function __construct(
        Slider $slider,
        Page $page,
        Site $website_detail,
        Post $post,
        Category $category,
        Product $product,
        Contact $contact,
        Career $career,
        Order $orders,
        Gallery $gallery,
        Team $team,
        Quote $quote
    ) {
        $this->slider = $slider;
        $this->page = $page;
        $this->website_detail = $website_detail;
        $this->post = $post;
        $this->quote = $quote;
        $this->category = $category;
        $this->product = $product;
        $this->contact = $contact;
        $this->career = $career;
        $this->orders = $orders;
        $this->gallery = $gallery;
        $this->team = $team;
    }
    public function homepage(Request $request)
    {
        $recognizations = Recognization::all();
        $quotes = Quote::all();
        $sliders = $this->slider->where(['status' => 'Publish'])->orderBy('id', 'DESC')->limit(3)->get();
        $other_product  = $this->product->where(['status' => 'Publish', 'is_other' => 1])->limit(4)->orderBy('id', 'DESC')->get();
        // dd( $other_product );
        $productss = $this->product->orderBy('id', 'DESC')->limit(8)->get();

        // dd($products);
        $featured_category = $this->category->where(['status' => 'Publish', 'is_featured' => 'yes'])->limit(4)->orderBy('id', 'DESC')->get();
        $meta_info = $this->page->where(['page_name' => 'index'])->first();

        $banner_category = $this->category->where(['status' => 'Publish', 'banner_category' => 'yes'])->first();

        $all_post = $this->post->where(['status' => 'Publish'])->orderBy('id', 'DESC')->get();
        // dd($all_post);



        return view('front.index', compact('sliders', 'other_product', 'productss', 'featured_category', 'meta_info', 'banner_category', 'all_post', 'recognizations', 'quotes'));
    }




    protected function contacts(Request $request)
    {
        $banners = Banner::all();
        $page_info = $meta_info = $this->page->where(['status' => 'Publish', 'page_name' => 'contact-us'])->first();

        return view('front.contact', compact('page_info', 'meta_info', 'banners'));
    }




    protected function blogs(Request $request)
    {
        $banners = Banner::all();
        $all_post = $this->post->where(['status' => 'Publish'])->orderBy('id', 'DESC')->paginate(9);
        $meta_info = $this->page->where(['page_name' => 'blog', 'status' => 'Publish'])->first();
        return view('front.blog.list', compact('all_post', 'meta_info', 'banners'));
    }




    protected function PostDetail(Request $request, $slug)
    {
        $banners = Banner::all();
        $post_detail = $this->post->where(['slug' => $slug, 'status' => 'Publish'])->first();
        if (!$post_detail) {
            abort(404);
        }
        $more_blog = $this->post->where(['status' => 'Publish'])->where('id', '!=', $post_detail->id)->orderBy('id', 'DESC')->limit(5)->get();
        return view('front.blog.bloginner', compact('post_detail', 'more_blog', 'banners'));
    }





    protected function about(Request $request)
    {
        $page_info  = $meta_info = $this->page->where(['page_name' => 'about', 'status' => 'Publish'])->first();
        if (!$page_info) {
            abort(404);
        }
        return view('front.pages.about', compact('page_info', 'meta_info'));
    }

    protected function pageDetail(Request $request)
    {
        $page_info  = $meta_info = $this->page->where(['slug' => 'terms-and-conditions', 'status' => 'Publish'])->first();
        if (!$page_info) {
            abort(404);
        }
        // return view('front.pages.legelPage', compact('page_info', 'meta_info'));
    }

    protected function privacy(Request $request)
    {
        $page_info  = $meta_info = $this->page->where(['slug' => 'privacy-policy', 'status' => 'Publish'])->first();
        if (!$page_info) {
            abort(404);
        }
        return view('front.pages.privacy', compact('page_info', 'meta_info'));
    }

    protected function team()
    {
        $banners = Banner::all();
        $teams = Team::all();
        return view('front.team', compact('teams', 'banners'));
    }
    protected function sustainibility()
    {
        $banners = Banner::all();
        $sustains = Sustain::all();

        return view('front.sustainibility', compact('sustains', 'banners'));
    }

    protected function client()
    {

        $banners = Banner::all();
        $customers = Client::all();
        $maps = Map::all();

        return view('front.client', compact('customers', 'banners', 'maps'));
    }
    protected function career()
    {
        $banners = Banner::all();
        $positions = Career::all();

        return view('front.career', compact('positions', 'banners'));
    }

    protected function media()
    {
        $banners = Banner::all();
        $videos = Media::all();

        return view('front.media', compact('videos', 'banners'));
    }

    protected function story()
    {
        $satya_story = SatyStory::first();
        //dd($satya_story);

        return view('front.story', compact('satya_story'));
    }

    protected function certificate()
    {
        $banners = Banner::all();
        $documents = Document::all();

        return view('front.certificate', compact('documents', 'banners'));
    }

    protected function process()
    {
        $banners = Banner::all();
        $operations = Process::all();


        return view('front.process', compact('operations', 'banners'));
    }





    public function getProductByCategory($slug, Request $request)
    {


        $page_info = $meta_info = $this->page->where(['slug' => $slug, 'status' => 'Publish'])->first();

        $cat_info = $this->category->where(['slug' => $slug, 'status' => 'Publish'])->first();
        if (!$cat_info) {
            abort(404);
        }

        return view('front.product.list', compact('cat_info'));
    }

    public function galleryDetail(Request $request, $slug)
    {
        $gallery_info   = $this->gallery->where(['status' => 'Publish', 'slug' => $slug])->first();
        if (!$gallery_info) {
            abort(404);
        }

        return view('front.gallery.gallery-detail', compact('gallery_info'));
    }

    protected function ProductDetail($slug, Request $request)
    {
        $product_info = $this->product->where(['status' => 'Publish', 'slug' => $slug])->first();
        if (!$product_info) {
            abort(404);
        }
        $cat_info = $this->category->where(['id' => $product_info->cat_id, 'status' => 'Publish'])->first();
        // dd($cat_info);
        if (isset($cat_info) && (($cat_info->is_parent == 0) || ($cat_info->is_parent == null))) {
            $child_cat = $cat_info;
            $new_cat_info  = $this->category->where(['id' => $cat_info->parent_id])->first();
            $cat_info = $new_cat_info;
            if (isset($new_cat_info) && (($new_cat_info->is_parent == 0) || ($new_cat_info->is_parent ==  null))) {
                $grand_child_cat  = $child_cat;
                $child_cat = $new_cat_info;
                $final_cat_info = $this->category->where(['id' => $new_cat_info->parent_id])->first();
                $cat_info = $final_cat_info;

                return view('front.product.product-detail', compact('product_info', 'cat_info', 'child_cat', 'grand_child_cat'));
            }
            return view('front.product.product-detail', compact('product_info', 'cat_info', 'child_cat'));
        }
        return view('front.product.product-detail', compact('product_info'));
    }













    public function getCategories($id)
    {
        //parent_id $id;
        $child_category  = $this->category->where(['parent_id' => $id])->get()->toArray();
        return $child_category;
    }






    public function buyNow($slug, Request $request)
    {
        $product_info = $this->product->where(['status' => 'Publish', 'slug' => $slug])->first();
        if (!$product_info) {
            abort(404);
        }

        $cat_info = $this->category->where(['id' => $product_info->cat_id, 'status' => 'Publish'])->first();
        // dd($cat_info);
        if (isset($cat_info) && (($cat_info->is_parent == 0) || ($cat_info->is_parent == null))) {
            $child_cat = $cat_info;
            $new_cat_info  = $this->category->where(['id' => $cat_info->parent_id])->first();
            $cat_info = $new_cat_info;
            if (isset($new_cat_info) && (($new_cat_info->is_parent == 0) || ($new_cat_info->is_parent ==  null))) {
                $grand_child_cat  = $child_cat;
                $child_cat = $new_cat_info;
                $final_cat_info = $this->category->where(['id' => $new_cat_info->parent_id])->first();
                $cat_info = $final_cat_info;

                return view('front.product.buy-now', compact('product_info', 'cat_info', 'child_cat', 'grand_child_cat'));
            }
            return view('front.product.buy-now', compact('product_info', 'cat_info', 'child_cat'));
        }
        return view('front.product.buy-now', compact('product_info'));
    }


    //contact message processing
    public function submitContact(Request $request)
    {

        date_default_timezone_set("Asia/Kathmandu");
        // $secure_old_coockie = Cookie::get('_tb');
        // if (isset($secure_old_coockie) && (!empty($secure_old_coockie))) {
        //     return response()->json(['status' => false, 'message' => ["Sorry You have requested for a contact message.Please try again later."]]);
        // }
        Cookie::queue('_tb', 'onebyone', 5);
        // $old_coockie = Cookie::get('_fd');

        // if (isset($old_coockie) && !empty($old_coockie)) {
        //     $request->session()->flash('error', 'Sorry ! There was problem while sending your message to the server please try again later.');
        //     return response()->json(['status' => false, 'message' => ["Sorry There was problem while submitting your feedback. Please Try again later."]]);
        // }
        parse_str($request->contact, $message);
        $data = $message;
        // dd($data['footer_form']);
        if (isset($data['footer_form'])) {
            $validation = Validator::make($data, [
                'first_name'    => 'required|string',
                'last_name'    => 'required|string',

                'phone'         => 'nullable|numeric',
                'email'         => 'required|string',
                'message'       => 'required|string',
            ]);
        } else {
            $validation = Validator::make($data, [

                'name'          => 'nullable|string',
                'phone'         => 'required|numeric',
                'email'         => 'required|string',
                'message'       => 'required|string',
            ]);
        }


        if ($validation->fails()) {
            foreach ($validation->messages()->getMessages() as $message) {
                $errors[] = $message;
            }
            return response()->json(['status' => false, 'message' => $errors]);
        }
        if (isset($data['footer_form'])) {
            $data['name'] = $data['first_name'] . " " . $data['last_name'];
            $data['phone'] = "none";
        }

        $this->contact->fill($data);

        $success = $this->contact->save();

        if ($success) {
            $apply_data['name'] = $data['name'];
            $apply_data['email'] = $data['email'];
            $apply_data['phone'] = $data['phone'];
            $apply_data['message'] = $data['message'];
            $apply_data = compact('apply_data');


            // Mail::send('front.mail-forms.email-text', $apply_data, function($message) use ($data){
            //     $message->to($this->mail_address, 'Admin')
            //     ->subject('Feedback Received');
            //     $message->from($data['email'], $data['name']);
            // });
            return response()->json(['status' => true, 'message' => "Thank You, Your feedback has been Submitted to Admin."])->cookie('_fd', 'noresponse', 5);
        } else {
            return response()->json(['status' => false, 'message' => ["Sorry There was problem while submitting your feedback. Please Try again later."]]);
        }
    }
    public function submitCareer(Request $request)
    {
        dd($reuest);
        date_default_timezone_set("Asia/Kathmandu");
        // $secure_old_coockie = Cookie::get('_tb');
        // if (isset($secure_old_coockie) && (!empty($secure_old_coockie))) {
        //     return response()->json(['status' => false, 'message' => ["Sorry You have requested for a contact message.Please try again later."]]);
        // }
        Cookie::queue('_tb', 'onebyone', 5);
        // $old_coockie = Cookie::get('_fd');

        // if (isset($old_coockie) && !empty($old_coockie)) {
        //     $request->session()->flash('error', 'Sorry ! There was problem while sending your message to the server please try again later.');
        //     return response()->json(['status' => false, 'message' => ["Sorry There was problem while submitting your feedback. Please Try again later."]]);
        // }
        parse_str($request->career, $message);
        $data = $message;
        // dd($data['footer_form']);
        if (isset($data['footer_form'])) {
            $validation = Validator::make($data, [
                'first_name'    => 'required|string',
                'last_name'    => 'required|string',

                'phone'         => 'nullable|numeric',
                'email'         => 'required|string',
                'message'       => 'required|string',
            ]);
        } else {
            $validation = Validator::make($data, [

                'name'          => 'nullable|string',
                'phone'         => 'required|numeric',
                'email'         => 'required|string',
                'message'       => 'required|string',
            ]);
        }


        if ($validation->fails()) {
            foreach ($validation->messages()->getMessages() as $message) {
                $errors[] = $message;
            }
            return response()->json(['status' => false, 'message' => $errors]);
        }
        if (isset($data['footer_form'])) {
            $data['name'] = $data['first_name'] . " " . $data['last_name'];
            $data['phone'] = "none";
        }

        $this->career->fill($data);

        $success = $this->contact->save();

        if ($success) {
            $apply_data['name'] = $data['name'];
            $apply_data['email'] = $data['email'];
            $apply_data['phone'] = $data['phone'];
            $apply_data['message'] = $data['message'];
            $apply_data = compact('apply_data');


            // Mail::send('front.mail-forms.email-text', $apply_data, function($message) use ($data){
            //     $message->to($this->mail_address, 'Admin')
            //     ->subject('Feedback Received');
            //     $message->from($data['email'], $data['name']);
            // });
            return response()->json(['status' => true, 'message' => "Thank You, Your feedback has been Submitted to Admin."])->cookie('_fd', 'noresponse', 5);
        } else {
            return response()->json(['status' => false, 'message' => ["Sorry There was problem while submitting your feedback. Please Try again later."]]);
        }
    }


    // Submit form

    // public function submitForm(Request $request){
    //     date_default_timezone_set("Asia/Kathmandu");
    //     // $secure_old_coockie = Cookie::get('_tb');
    //     // if (isset($secure_old_coockie) && (!empty($secure_old_coockie))) {
    //     //     return response()->json(['status' => false, 'message' => ["Sorry You have requested for a contact message.Please try again later."]]);
    //     // }
    //     Cookie::queue('_tb', 'onebyone', 5);
    //     // $old_coockie = Cookie::get('_fd');

    //     // if (isset($old_coockie) && !empty($old_coockie)) {
    //     //     $request->session()->flash('error', 'Sorry ! There was problem while sending your message to the server please try again later.');
    //     //     return response()->json(['status' => false, 'message' => ["Sorry There was problem while submitting your feedback. Please Try again later."]]);
    //     // }
    //     parse_str($request->contact, $message);
    //     $data = $message;
    //     // dd($data['footer_form']);
    //     if(isset($data['footer_form']) ){
    //         $validation = Validator::make($data, [
    //             'first_name'    => 'required|string',
    //             'last_name'    => 'required|string',

    //             'phone'         => 'nullable|numeric',
    //             'email'         => 'required|string',
    //             'image'       => 'required|string',
    //         ]);
    //     }
    //     else {
    //         $validation = Validator::make($data, [

    //             'name'          => 'nullable|string',
    //             'phone'         => 'required|numeric',
    //             'email'         => 'required|string',
    //             'message'       => 'required|string',
    //         ]);
    //     }


    //     if ($validation->fails()) {
    //         foreach ($validation->messages()->getMessages() as $message) {
    //             $errors[] = $message;
    //         }
    //         return response()->json(['status' => false, 'message' => $errors]);
    //     }
    //     if(isset($data['footer_form'])){
    //         $data['name'] = $data['first_name']." ".$data['last_name'];
    //         $data['phone'] = "none";
    //     }

    //     $this->contact->fill($data);

    //     $success= $this->contact->save();

    //     if ($success) {
    //         $apply_data['name'] = $data['name'];
    //         $apply_data['email'] = $data['email'];
    //         $apply_data['phone'] = $data['phone'];
    //         $apply_data['message'] = $data['message'];
    //         $apply_data = compact('apply_data');


    //             // Mail::send('front.mail-forms.email-text', $apply_data, function($message) use ($data){
    //             //     $message->to($this->mail_address, 'Admin')
    //             //     ->subject('Feedback Received');
    //             //     $message->from($data['email'], $data['name']);
    //             // });
    //         return response()->json(['status' => true, 'message' => "Thank You, Your feedback has been Submitted to Admin."])->cookie('_fd', 'noresponse', 5);
    //     } else {
    //         return response()->json(['status' => false, 'message' => ["Sorry There was problem while submitting your feedback. Please Try again later."]]);
    //     }
    // }

    //End of submit form




    protected function SubmitOrder(Request $request)
    {
        parse_str($request->order, $order);

        $validation = Validator::make($order, [
            'message'      => 'nullable|string|max:300',
            'name'          => 'required|string',
            'phone'         => 'required|numeric',
            'email'         => 'required|email',
            'location'      => 'required|string|max:150',
            'quantity'      => 'required|numeric|min:1|max:10'

        ]);
        if ($validation->fails()) {
            foreach ($validation->messages()->getMessages() as $message) {
                $errors[] = $message;
            }
            return response()->json(['status' => false, 'message' => $errors]);
        }
        $product_info = $this->product->where(['status' => 'Publish', 'id' => $order['id']])->first();
        if (!$product_info) {
            return response()->json(['status' => false, 'message' => ['Invalid product order request.']]);
        }

        $order['product_id'] = $product_info->id;
        $order['price']     = $product_info->price;
        $order['discount'] = $product_info->discount;
        $order['status']  = 'New';
        $order['quantity']  = $order['quantity'];
        $order['order_id'] = Str::random(10);

        // dd($order);

        // now saving order
        $this->orders->fill($order);

        $success = $this->orders->save();
        if ($success) {
            $order_data['message'] = $order['message'];
            $order_data['name'] = $order['name'];
            $order_data['phone'] = $order['phone'];
            $order_data['email'] = $order['email'];
            $order_data['location'] = $order['location'];
            $order_data['discount'] = $order['discount'];
            $order_data['amount'] = discount($product_info->price, $product_info->discount);
            $order_data['title'] = $product_info->title;
            $order_data['order_id'] = $order['order_id'];
            $order_data = compact('order_data');

            // Mail::send('front.mail-forms.order-mail', $order_data, function($message) use ($order){
            //     $message->to($this->mail_address, 'Admin')
            //     ->subject('Order Request recieved from ');
            //     $message->from($order['email'], $order['name']);
            // });
            return response()->json(['status' => true, 'message' => "Thank You, Your order has been successfully placed . We will Contact you soon."]);
        } else {
            return response()->json(['status' => false, 'message' => ["Sorry There was problem while submitting your Order request. Please Try again later."]]);
        }
    }

    public function SearchProduct(Request $request)
    {

        $request->validate([
            'key' => 'required|string',
        ]);
        $key = $request->input('key');
        // $cat_info = $this->category->where(function ($query) use ($key) {
        //     $query->where('status', 'Publish')->Where('title', 'like', '%' . $key . '%');
        // })->get();
        // $pro_info = $this->product->where(function ($query) use ($key) {
        //     $query->where('status', 'Publish')->Where('title', 'like', '%' . $key . '%');
        // })->get();

        $results = [
            'categories' => $this->category->where('status', 'Publish')->where('title', 'like', '%' . $key . '%')->get(),
            'products' => $this->product->where('status', 'Publish')->where('title', 'like', '%' . $key . '%')->get(),
        ];

        $categoryIds = $results['categories']->pluck('id');
        $relatedProducts = $this->product->where('status', 'Publish')->whereIn('cat_id', $categoryIds)->get();
        $title = 'Your search result for products with title containing "' . $key . '"';
        return view('front.search', compact('results', 'relatedProducts', 'title'));
    }

    //All categories
    public function allCategories()
    {
        $page_info = $meta_info = $this->category->where(['status' => 'Publish'])->first();
        // dd($page_info);

        if (!$page_info) {
            abort(404);
        }
        return view('front.all_categories', compact('page_info', 'meta_info'));
        // return view('front.all_categories');
    }


    public function getProductByCategories($slug, Request $request)
    {

        $categoryProducts = Category::with('products')->where(['status' => 'Publish', 'slug' => $slug])->orderBy('created_at', 'asc')->get();
        $cat_info = $this->category->where(['slug' => $slug, 'status' => 'Publish'])->first();

        return view('front.product.test_list', compact('categoryProducts', 'cat_info'));
    }


    public function getSubcategories($slug, Request $request)
    {
        $page_info = $meta_info = $this->category->where(['status' => 'Publish'])->first();
        // dd($page_info);
        if (!$page_info) {
            abort(404);
        }
        $totalCategories = Category::with('subcategories')->where(['status' => 'Publish', 'slug' => $slug])->orderBy('created_at', 'asc')->paginate(12);
        // dd($allSubCategories);
        return view('front.all_subcategories', compact('totalCategories', 'page_info', 'meta_info'));
    }


    public function allProduct(Request $request)
    {


        $products = $this->product->orderBy('id', 'DESC');


        //dd($products);

        return view('front.product.all-product', compact('products'));
    }
}
