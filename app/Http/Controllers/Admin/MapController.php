<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Map;


class MapController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $maps = Map::all();
        return view('admin.map.index', compact('maps'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.map.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $map = new Map();
        $map->title = $request->title;
        $map->description = $request->description;
        if ($request->hasFile('map_image')) {
            $file = $request->map_image;
            $newName = time() . $file->getClientOriginalName();
            $file->move('images', $newName);
            $map->map_image = "images/$newName";
        }
        $map->save();
        return redirect('/map');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $map = Map::find($id);
        return view('admin.map.edit', compact('map'));
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
        $map = Map::find($id);
        $map->title = $request->title;


        $map->description = $request->description;
        if ($request->hasFile('map_image')) {
            $file = $request->map_image;
            $newName = time() . $file->getClientOriginalName();
            $file->move('images', $newName);
            $map->map_image = "images/$newName";
        }
        $map->update();
        return redirect('/map');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $map = Map::find($id);
        $map->delete();
        return redirect('/map');
    }
}
