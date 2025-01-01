<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sustain;
use Illuminate\Http\Request;

class SustainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sustains=Sustain::all();
    return view('admin.sustain.index',compact('sustains'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('admin.sustain.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sustain=new Sustain();
        $sustain->short_description=$request->short_description;
        $sustain->description=$request->description;
        if ($request->hasFile('image1')) {
            $file = $request->image1;
            $newName = time() . $file->getClientOriginalName();
            $file->move('images',$newName);
            $sustain->image1="images/$newName";
        }
        $sustain->save();
        return redirect('/sustain');
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
        $sustain=Sustain::find($id);
        return view('admin.sustain.edit',compact('sustain'));
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
        $sustain= Sustain::find($id);
        $sustain->short_description=$request->short_description;
        $sustain->description=$request->description;
        if ($request->hasFile('image1')) {
            $file = $request->image1;
            $newName = time() . $file->getClientOriginalName();
            $file->move('images',$newName);
            $sustain->image1="images/$newName";
        }
        $sustain->update();
        return redirect('/sustain');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sustain=Sustain::find($id);
        $sustain->delete();
        return redirect('/sustain');
    }
}
