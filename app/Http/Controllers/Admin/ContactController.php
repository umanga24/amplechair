<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Front\Contact;
use Validator;
use Mail;
use Cookie;
class ContactController extends Controller{
    protected $contact = null;
    public function __construct(Contact $_contact){
        $this->contact =$_contact;
    }
    public function listAllMessage(Request $request){
        $all_message = $this->contact->orderBy('id', 'DESC')->get();
        return view('admin.contact.list', compact('all_message'));
    }
    

    public function delete($id, Request $request){
        // dd($id);
        $this->contact = $this->contact->find($id);
        if (!$this->contact) {
            $request->session()->flash('error', 'Message detail not found.');
            return redirect()->route('list-all-message');
        }
        $del= $this->contact->delete();
        if($del){
 

            $request->session()->flash('success', 'Message deleted successfully');
        } else {
            $request->session()->flash('error', 'Sorry! Message could not be deleted at this moment.');
        }
        return redirect()->route('list-all-message');
    }
}
