<?php

namespace App\Http\Controllers;

use App\Http\Requests\Intern\InternStoreRequest;
use App\Http\Requests\Intern\InternUpdateRequest;
use App\Models\Intern;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class InternController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny',Intern::class);
        return response()->json(['interns'=>Intern::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Request\InternStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(InternStoreRequest $request)
    {
        $this->authorize('create',Intern::class);
        return response()->json(['intern'=>Intern::create($request->validated())]);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(['intern'=>Intern::find($id)]);
    }
    /**
     * Display all intern's data.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showInfo($id)
    {
        $this->authorize('view',Intern::class);
        $response=[];
        $response[]=DB::table('interns')
            ->join('groups','interns.group_id','=','groups.id')
            ->select('interns.*','groups.*')
            ->where('interns.id','=',$id)
            ->get();
        $response[]=DB::table('reviews')
            ->join('interns','interns.id','=','reviews.intern_id')
            ->join('users','reviews.mentor_id','=','users.id')
            ->join('assignements','reviews.assignement_id','=','assignements.id')
            ->select(
            'assignements.title as assignment_title',
            'assignements.description as assignment_desc',
            'assignements.date_assigned',
            'assignements.finish_date',
            'users.name as mentor_name',
            'users.lastname as mentor_lastname',
            'users.skype as mentor_skype',
            'reviews.mark',
            'reviews.pros',
            'reviews.cons',
            'reviews.date_reviewed')
            ->where('interns.id','=',$id)
            ->get();
        return response()->json(['intern'=>$response]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Request\InternUpdateRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(InternUpdateRequest $request, $id)
    {
        $intern= Intern::find($id);
        $this->authorize('update',$intern);
        $intern->update($request->validated());
        return response()->json(['intern'=>$intern]);        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('delete',Intern::class);
        return Intern::destroy($id); 
    }
}
