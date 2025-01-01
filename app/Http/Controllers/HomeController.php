<?php

namespace App\Http\Controllers;

use App\Models\Admin\Category;
use App\Models\Admin\Order;
use App\Models\Admin\Post;
use App\Models\Admin\Product;
use App\Models\Admin\Slider;
use App\Models\Admin\Subscriber;
use App\Models\Front\Contact;
use Illuminate\Http\Request;

class HomeController extends Controller{
    private $post = null;
    private $category =null;
    private $product = null;
    private $order = null;
    private $slider =null;
    private $subscriber = null;
    private $message = null;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct( Post $post, Category $category, Product $product, Order $order, Slider $slider, Subscriber $subscriber, Contact $message){
        $this->middleware('auth');
        $this->post = $post;
        $this->category = $category;
        $this->product = $product;
        $this->order = $order;
        $this->slider = $slider;
        $this->subscriber = $subscriber;
        $this->message = $message;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index( Request $request){
        // return view('home');
        if($request->user()->roles== "admin"){
            return redirect()->route('admin');

        } else if($request->user()->roles == 'User'){
            return redirect()->route('user');
        }
    }
    public function admin(){
        $blogs = count($this->post->get());
        $cat = count($this->category->get());
        $products = count($this->product->get());
        $orders = count($this->order->where('status', 'New')->get());
        $sliders = count($this->slider->get());
        $subscribers = count($this->subscriber->get());
        $messages = count($this->message->get());
        return view('admin.dashboard', compact('blogs', 'cat', 'products', 'orders', 'sliders', 'subscribers', 'messages'));
    }
}
