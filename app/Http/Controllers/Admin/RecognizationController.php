<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Recognization;
use Illuminate\Http\Request;

class RecognizationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recognizations=Recognization::all();
        return view('admin.recognization.index',compact('recognizations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.recognization.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $recognization=new Recognization();
        $recognization->link=$request->link;

        if ($request->hasFile('image2')) {
            $file = $request->image2;
            $newName = time() . $file->getClientOriginalName();
            $file->move('images',$newName);
            $recognization->image2="images/$newName";
        }
        $recognization->save();
        return redirect('/recognization');
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
        $recognization=Recognization::find($id);
        return view('admin.recognization.edit',compact('recognization'));
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
        $recognization= Recognization::find($id);
        $recognization->link=$request->link;

        if ($request->hasFile('image2')) {
            $file = $request->image2;
            $newName = time() . $file->getClientOriginalName();
            $file->move('images',$newName);
            $recognization->image2="images/$newName";
        }
        $recognization->update();
        return redirect('/recognization');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
     $recognization=Recognization::find($id);
     $recognization->delete();
     return redirect('/recognization');
    }
}
