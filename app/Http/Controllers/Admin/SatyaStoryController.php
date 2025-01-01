<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SatyStory;
use Illuminate\Http\Request;

class SatyaStoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $about_uss=SatyStory::all();
        return view('admin.satya_story.index',compact('about_uss'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.satya_story.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $satya_story=new SatyStory();
        $satya_story->satya_description=$request->satya_description;
        $satya_story->desc1=$request->desc1;
        $satya_story->desc2=$request->desc2;
        $satya_story->desc3=$request->desc3;

        if ($request->hasFile('satya_banner')) {
            $file = $request->satya_banner;
            $newName = time() . $file->getClientOriginalName();
            $file->move('images',$newName);
            $satya_story->satya_banner="images/$newName";
        }

        if ($request->hasFile('image')) {
            $file = $request->image;
            $newName = time() . $file->getClientOriginalName();
            $file->move('images',$newName);
            $satya_story->image="images/$newName";
        }
        if ($request->hasFile('image1')) {
            $file = $request->image1;
            $newName = time() . $file->getClientOriginalName();
            $file->move('images',$newName);
            $satya_story->image1="images/$newName";
        }
        if ($request->hasFile('image2')) {
            $file = $request->image2;
            $newName = time() . $file->getClientOriginalName();
            $file->move('images',$newName);
            $satya_story->image2="images/$newName";
        }
        if ($request->hasFile('image3')) {
            $file = $request->image3;
            $newName = time() . $file->getClientOriginalName();
            $file->move('images',$newName);
            $satya_story->image3="images/$newName";
        }
        $satya_story->save();
        return redirect('/about_us');
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
      $about_us=SatyStory::find($id);
      return view('admin.satya_story.edit',compact('about_us'));
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
        //dd($request->image1);
        $satya_story=SatyStory::find($id);
        $satya_story->satya_description=$request->satya_description;
        $satya_story->desc1=$request->desc1;

        $satya_story->desc2=$request->desc2;

        $satya_story->desc3=$request->desc3;



        if ($request->hasFile('image')) {
            $file = $request->image;
            $newName = time() . $file->getClientOriginalName();
            $file->move('images',$newName);
            $satya_story->image="images/$newName";
        }

        if ($request->hasFile('image1')) {
            $file = $request->image1;
            $newName = time() . $file->getClientOriginalName();
            $file->move('images',$newName);
            $satya_story->image1="images/$newName";
        }

        if ($request->hasFile('image2')) {
            $file = $request->image2;
            $newName = time() . $file->getClientOriginalName();
            $file->move('images',$newName);
            $satya_story->image2="images/$newName";
        }

        if ($request->hasFile('image3')) {
            $file = $request->image3;
            $newName = time() . $file->getClientOriginalName();
            $file->move('images',$newName);
            $satya_story->image3="images/$newName";
        }


        if ($request->hasFile('satya_banner')) {
            $file = $request->satya_banner;
            $newName = time() . $file->getClientOriginalName();
            $file->move('images',$newName);
            $satya_story->satya_banner="images/$newName";
        }
        $satya_story->update();
        return redirect('/about_us');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
