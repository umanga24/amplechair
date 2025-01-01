<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $banners=Banner::all();
        return view('admin.banner.index',compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $banner=Banner::all();
          return view('admin.banner.create',compact('banner'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $banner=new Banner();

        if ($request->hasFile('client_banner')) {
            $file1 = $request->client_banner;
            $newName1 = time() . $file1->getClientOriginalName();
            $file1->move('images',$newName1);
            $banner->client_banner="images/$newName1";
        }

        if ($request->hasFile('contact_banner')) {
            $file2 = $request->contact_banner;
            $newName2 = time() . $file2->getClientOriginalName();
            $file2->move('images',$newName2);
            $banner->contact_banner="images/$newName2";
        }

        if ($request->hasFile('sustain_banner')) {
            $file3 = $request->sustain_banner;
            $newName3 = time() . $file3->getClientOriginalName();
            $file3->move('images',$newName3);
            $banner->sustain_banner="images/$newName3";
        }

        if ($request->hasFile('media_banner')) {
            $file4 = $request->media_banner;
            $newName4 = time() . $file4->getClientOriginalName();
            $file4->move('images',$newName4);
            $banner->media_banner="images/$newName4";
        }
        if ($request->hasFile('certificate_banner')) {
            $file5 = $request->certificate_banner;
            $newName5 = time() . $file5->getClientOriginalName();
            $file5->move('images',$newName5);
            $banner->certificate_banner="images/$newName5";
        }

        if ($request->hasFile('team_banner')) {
            $file6 = $request->team_banner;
            $newName6 = time() . $file6->getClientOriginalName();
            $file6->move('images',$newName6);
            $banner->team_banner="images/$newName6";
        }

        if ($request->hasFile('process_banner')) {
            $file7 = $request->process_banner;
            $newName7 = time() . $file7->getClientOriginalName();
            $file7->move('images',$newName7);
            $banner->process_banner="images/$newName7";
        }

        if ($request->hasFile('career_banner')) {
            $file8 = $request->career_banner;
            $newName8 = time() . $file8->getClientOriginalName();
            $file8->move('images',$newName8);
            $banner->career_banner="images/$newName8";
        }

        if ($request->hasFile('blog_banner')) {
            $file9 = $request->blog_banner;
            $newName9 = time() . $file9->getClientOriginalName();
            $file9->move('images',$newName9);
            $banner->blog_banner="images/$newName9";
        }




        $banner->save();
        return redirect('/admin/banner');
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
        $banner=Banner::find($id);
        return view('admin.banner.edit',compact('banner'));

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
        $banner=Banner::find($id);

        if ($request->hasFile('client_banner')) {
            $file1 = $request->client_banner;
            $newName1 = time() . $file1->getClientOriginalName();
            $file1->move('images',$newName1);
            $banner->client_banner="images/$newName1";
        }

        if ($request->hasFile('contact_banner')) {
            $file2 = $request->contact_banner;
            $newName2 = time() . $file2->getClientOriginalName();
            $file2->move('images',$newName2);
            $banner->contact_banner="images/$newName2";
        }

        if ($request->hasFile('sustain_banner')) {
            $file3 = $request->sustain_banner;
            $newName3 = time() . $file3->getClientOriginalName();
            $file3->move('images',$newName3);
            $banner->sustain_banner="images/$newName3";
        }

        if ($request->hasFile('media_banner')) {
            $file4 = $request->media_banner;
            $newName4 = time() . $file4->getClientOriginalName();
            $file4->move('images',$newName4);
            $banner->media_banner="images/$newName4";
        }
        if ($request->hasFile('certificate_banner')) {
            $file5 = $request->certificate_banner;
            $newName5 = time() . $file5->getClientOriginalName();
            $file5->move('images',$newName5);
            $banner->certificate_banner="images/$newName5";
        }

        if ($request->hasFile('team_banner')) {
            $file6 = $request->team_banner;
            $newName6 = time() . $file6->getClientOriginalName();
            $file6->move('images',$newName6);
            $banner->team_banner="images/$newName6";
        }

        if ($request->hasFile('process_banner')) {
            $file7 = $request->process_banner;
            $newName7 = time() . $file7->getClientOriginalName();
            $file7->move('images',$newName7);
            $banner->process_banner="images/$newName7";
        }

        if ($request->hasFile('career_banner')) {
            $file8 = $request->career_banner;
            $newName8 = time() . $file8->getClientOriginalName();
            $file8->move('images',$newName8);
            $banner->career_banner="images/$newName8";
        }

        if ($request->hasFile('blog_banner')) {
            $file9 = $request->blog_banner;
            $newName9 = time() . $file9->getClientOriginalName();
            $file9->move('images',$newName9);
            $banner->blog_banner="images/$newName9";
        }




        $banner->update();
        return redirect('/admin/banner');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $banner=Banner::find($id);
        $banner->delete() ;
        return redirect('/admin/banner');
}}
