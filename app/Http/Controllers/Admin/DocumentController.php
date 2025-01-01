<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Document;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $documents=Document::all();
     return view('admin.certificate.index',compact('documents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.certificate.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $document=new Document();
        $document->certificate_title=$request->certificate_title;
        $document->short_description=$request->short_description;
        if ($request->hasFile('photo1')) {
            $file = $request->photo1;
            $newName = time() . $file->getClientOriginalName();
            $file->move('images',$newName);
            $document->photo1="images/$newName";
        }
        $document->save();
        return redirect('/document');
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
        $document=Document::find($id);
        return view('admin.certificate.edit',compact('document'));
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
        $document=Document::find($id);
        $document->certificate_title=$request->certificate_title;
        $document->short_description=$request->short_description;
        if ($request->hasFile('photo1')) {
            $file = $request->photo1;
            $newName = time() . $file->getClientOriginalName();
            $file->move('images',$newName);
            $document->photo1="images/$newName";
        }
        $document->update();
        return redirect('/document');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $document=Document::find($id);
        $document->delete();
        return redirect('/document');
    }
}
