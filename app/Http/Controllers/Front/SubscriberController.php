<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Subscriber;
use Validator;
use Cookie;
class SubscriberController extends Controller{
    protected $subscriber = null;
    public function __construct(Subscriber $_subscriber){
    	$this->subscriber = $_subscriber;
    }
    public function listAllsubscriber(Request $request){
        $subscribers = $this->subscriber->orderBy('id', 'DESC')->get();
        return view('admin.subscribers.list', compact('subscribers'));
    }
    public function addSubscriber(Request $request){
    	// dd($request);

        $old_coockie = Cookie::get('_sb');
         
        if (isset($old_coockie) && !empty($old_coockie)) {
            return response()->json(['status' => false, 'message' => ["Sorry ! There was problem while subscribing. Please try again later."]]);
        }
    	 
        $data = $request->all();
        $data['full_name'] = $data['sub_full_name'];
        $data['email'] = $data['sub_email'];

        $validation = Validator::make($data, [
           	'full_name'             =>  'required|string',
            'email'    				=>  'required|unique:subscribers,email',
        ]);
        if ($validation->fails()) {
            foreach ($validation->messages()->getMessages() as $message) {
                $errors[] = $message;
            }    
            return response()->json(['status' => false, 'message' => $errors]);
        }
        $this->subscriber->fill($data);
        $success= $this->subscriber->save();
        
        if($success){
            return response()->json(['status' => true, 'message' => 'Congratulations, You have been  Successfully subscribed.'])->cookie('_sb', 'xsfddsald', 10);
        } else {
            return response()->json(['status' => false, 'message' => ['Sorry ! There was problem while submitting your request. Please try again later.']]);
        }
    }

    public function delete($id, Request $request){
        $this->subscriber = $this->subscriber->find($id);
        if (!$this->subscriber) {
            $request->session()->flash('error', 'Subscriber detail not found.');
            return redirect()->route('list-subscriber');
        }
        $del= $this->subscriber->delete();
        if($del){
 

            $request->session()->flash('success', 'Subscriber deleted successfully');
        } else {
            $request->session()->flash('error', 'Sorry! Subscriber could not be deleted at this moment.');
        }
        return redirect()->route('list-subscriber');
    }
}
