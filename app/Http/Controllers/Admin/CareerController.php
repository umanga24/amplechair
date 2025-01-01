<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Career;
use Illuminate\Http\Request;

class CareerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $positions=Career::all();
        return view('admin.career.index',compact('positions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $position=Career::first();
        return view('admin.career.create',compact('position'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $position=new Career();
        $position->post_title=$request->post_title;
        $position->post_description=$request->post_description;
        $position->name=$request->name;
        $position->email=$request->email;
        $position->phone=$request->phone;
        if ($request->hasFile('banner_image')) {
            $file1 = $request->banner_image;
            $newName1 = time() . $file1->getClientOriginalName();
            $file1->move('images',$newName1);
            $position->banner_image="images/$newName1";
        }

        if ($request->hasFile('post_image')) {
            $file2 = $request->post_image;
            $newName2 = time() . $file2->getClientOriginalName();
            $file2->move('images',$newName2);
            $position->post_image="images/$newName2";
        }




        $position->save();
        return redirect('/position');
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
        $position=Career::find($id);
        return view('admin.career.edit',compact('position'));
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
        $position=Career::find($id);
        $position->post_title=$request->post_title;
        $position->post_description=$request->post_description;
        $position->name=$request->name;
        $position->email=$request->email;
        $position->phone=$request->phone;
        if ($request->hasFile('banner_image')) {
            $file1 = $request->banner_image;
            $newName1 = time() . $file1->getClientOriginalName();
            $file1->move('images',$newName1);
            $position->banner_image="images/$newName1";
        }

        if ($request->hasFile('post_image')) {
            $file2 = $request->post_image;
            $newName2 = time() . $file2->getClientOriginalName();
            $file2->move('images',$newName2);
            $position->post_image="images/$newName2";
        }




        $position->update();
        return redirect('/position');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $position=Career::find($id);
        $position->delete();
        return redirect('/position');
    }
}
