<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;
use Illuminate\Support\Facades\DB;


class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny',Group::class);
        return Group::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create',Group::class);
        $request->validate([
            'title' => 'required'
        ]);
        return Group::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->authorize('view',Group::class);
        return Group::find($id);
    }

    /**
     * Display group's all members.
     * 
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function showInfo($id)
    {
        $this->authorize('view',Group::class);
        $response=[];
        $response[]=DB::table('groups')
            ->join('interns','groups.id','=','interns.group_id')
            ->select('interns.name','interns.lastname','interns.email')
            ->where('groups.id','=',$id)
            ->get();
        $response[]=DB::table('groups')
            ->join('users','groups.id','=','users.group_id')
            ->select('users.name as mentor_name','users.lastname as mentor_lastname','users.skype')
            ->where('groups.id','=',$id)
            ->get();
        $response[]=DB::table('groups')
            ->join('assignements','groups.id','=','assignements.group_id')
            ->select('assignements.title','assignements.description','assignements.date_assigned','assignements.finish_date')
            ->where('groups.id','=',$id)
            ->get();
        return $response;    
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
        $this->authorize('update',Group::class);
        $request->validate([
            'title' => 'required'
        ]);

        $group=Group::find($id);
        $group->update($request->all());
        return $group;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('delete',Group::class);
        return Group::destroy($id);
    }
}
