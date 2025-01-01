<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Process;
use Illuminate\Http\Request;

class ProcessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $operations=Process::all();
        return view('admin.process.index',compact('operations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $operation=Process::first();
        return view('admin.process.create',compact('operation'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $operation=new Process();
        $operation->process_title=$request->process_title;
        $operation->process_description=$request->process_description;
        if ($request->hasFile('process_image')) {
            $file1 = $request->process_image;
            $newName1 = time() . $file1->getClientOriginalName();
            $file1->move('images',$newName1);
            $operation->process_image="images/$newName1";
        }

        if ($request->hasFile('process_banner_image')) {
            $file2 = $request->process_banner_image;
            $newName2 = time() . $file2->getClientOriginalName();
            $file2->move('images',$newName2);
            $operation->process_banner_image="images/$newName2";
        }




        $operation->save();
        return redirect('/operation');
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
        $operation=Process::find($id);
        return view('admin.process.edit',compact('operation'));

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
        $operation=Process::find($id);
        $operation->process_title=$request->process_title;
        $operation->process_description=$request->process_description;
        if ($request->hasFile('process_image')) {
            $file1 = $request->process_image;
            $newName1 = time() . $file1->getClientOriginalName();
            $file1->move('images',$newName1);
            $operation->process_image="images/$newName1";
        }

        if ($request->hasFile('process_banner_image')) {
            $file2 = $request->process_banner_image;
            $newName2 = time() . $file2->getClientOriginalName();
            $file2->move('images',$newName2);
            $operation->process_banner_image="images/$newName2";
        }




        $operation->update();
        return redirect('/operation');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $operation=Process::find($id);
        $operation->delete();
        return redirect('/operation');
    }
}
