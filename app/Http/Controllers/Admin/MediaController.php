<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Media;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $videos=Media::all();
        return view('admin.media.index',compact('videos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.media.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $video=new Media();
        $video->link=$request->link;

        if ($request->hasFile('media_image')) {
            $file = $request->media_image;
            $newName = time() . $file->getClientOriginalName();
            $file->move('images',$newName);
            $video->media_image="images/$newName";
        }
        $video->save();
        return redirect('/video');
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
        $video=Media::find($id);
        return view('admin.media.edit',compact('video'));
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
        $video=Media::find($id);
        $video->link=$request->link;

        if ($request->hasFile('media_image')) {
            $file = $request->media_image;
            $newName = time() . $file->getClientOriginalName();
            $file->move('images',$newName);
            $video->media_image="images/$newName";
        }
        $video->update();
        return redirect('/video');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $video=Media::find($id);
        $video->delete();
        return redirect('/video');
    }
}
