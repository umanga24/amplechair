<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Client::all();
        return view('admin.client.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.client.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $customer = new Client();
        $customer->title = $request->title;
        $customer->subtitle = $request->subtitle;
        $customer->country = $request->country;
        $customer->description = $request->description;
        if ($request->hasFile('client_image')) {
            $file = $request->client_image;
            $newName = time() . $file->getClientOriginalName();
            $file->move('images', $newName);
            $customer->client_image = "images/$newName";
        }
        $customer->save();
        return redirect('/customer');
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
        $customer = Client::find($id);
        return view('admin.client.edit', compact('customer'));
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
        $customer = Client::find($id);
        $customer->title = $request->title;
        $customer->subtitle = $request->subtitle;
        $customer->country = $request->country;
        $customer->description = $request->description;
        if ($request->hasFile('client_image')) {
            $file = $request->client_image;
            $newName = time() . $file->getClientOriginalName();
            $file->move('images', $newName);
            $customer->client_image = "images/$newName";
        }
        $customer->update();
        return redirect('/customer');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Client::find($id);
        $customer->delete();
        return redirect('/customer');
    }
}
