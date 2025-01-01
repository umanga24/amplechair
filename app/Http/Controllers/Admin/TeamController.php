<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $back_teams=Team::all();
        return view('admin.team.index',compact('back_teams'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.team.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $team=new Team();
        $team->name=$request->name;
        $team->designation=$request->designation;
        if ($request->hasFile('photo')) {
            $file = $request->photo;
            $newName = time() . $file->getClientOriginalName();
            $file->move('images',$newName);
            $team->photo="images/$newName";
        }
        $team->save();
        return redirect('/back_team');
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
        $back_team=Team::find($id);
        return view('admin.team.edit',compact('back_team'));
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
        $team=Team::find($id);
        $team->name=$request->name;
        $team->designation=$request->designation;
        if ($request->hasFile('photo')) {
            $file = $request->photo;
            $newName = time() . $file->getClientOriginalName();
            $file->move('images',$newName);
            $team->photo="images/$newName";
        }
        $team->update();
        return redirect('/back_team'); //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $team=Team::find($id);
        $team->delete();
        return redirect('/back_team');
    }
}
