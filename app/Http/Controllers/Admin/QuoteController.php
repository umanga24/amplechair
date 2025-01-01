<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Quote;
use Illuminate\Http\Request;

class QuoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quotes=Quote::all();
    return view('admin.quote.index',compact('quotes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.quote.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $quote=new Quote();
        $quote->quote_title=$request->quote_title;
        $quote->quote_description=$request->quote_description;
        if ($request->hasFile('quote_image')) {
            $file = $request->quote_image;
            $newName = time() . $file->getClientOriginalName();
            $file->move('images',$newName);
            $quote->quote_image="images/$newName";
        }
        $quote->save();
        return redirect('/quote');
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
        $quote=Quote::find($id);
        return view('admin.quote.edit',compact('quote'));
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
        $quote=Quote::find($id);
        $quote->quote_title=$request->quote_title;
        $quote->quote_description=$request->quote_description;
        if ($request->hasFile('quote_image')) {
            $file = $request->quote_image;
            $newName = time() . $file->getClientOriginalName();
            $file->move('images',$newName);
            $quote->quote_image="images/$newName";
        }
        $quote->update();
        return redirect('/quote');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $quote=Quote::find($id);
        $quote->delete();
        return redirect('/quote');
    }
}
