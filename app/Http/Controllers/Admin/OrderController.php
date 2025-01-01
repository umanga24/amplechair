<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Order;
class OrderController extends Controller{
    protected $order = null;
    public function __construct(Order $order){
    	$this->order = $order;
    }
    public function orderList( Request $request){
    	$orders = $this->order->orderBy('id', 'DESC')->get();
    	// dd($orders);
    	return view('admin.order.list', compact('orders'));
    }
    public function updateOrder(Request $request, $id){
    	$order_info  = $this->order->find($id);
    	if (!$order_info) {
    		$request->session()->flash('error', 'Order detail not found');
    		return redirect()->route('order-list');
    	}
    	return view('admin.order.create', compact('order_info'));
    }
    public function Update(Request $request, $id){
    	$this->order = $this->order->find($id);
    	if (!$this->order) {
    		$request->session()->flash('error', 'Order Detail Not found.');
    		return redirect()->back();
    	}
    	$this->validate($request,[
            'status'=>'required|in:New,Verified,Cancel,Process,Delivered'
        ]);
    	$data['status'] = $request->status;
    	// dd($this->order);
    	$this->order->fill($data);
    	$success = $this->order->save();
    	if ($success) {
    		$request->session()->flash('success', 'Order updated successfully.');
    	} else {
    		$request->session()->flash('error', 'Sorry!, There was problem while updating order.');
    	}
    	return redirect()->route('order-list');
    }
}
