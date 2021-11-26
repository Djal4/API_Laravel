<?php

namespace App\Http\Controllers;

use App\Models\Assignement;
use App\Http\Requests\Assignment\AssignmentCopyRequest;
use App\Http\Requests\Assignment\AssignmentStoreRequest;
use App\Http\Requests\Assignment\AssignmentUpdateRequest;

class AssignementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny',Assignement::class);
        return response()->json(['assignment'=>Assignement::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\Assignment\AssignmentStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AssignmentStoreRequest $request)
    {
        $this->authorize('create',Assignement::class);
        return response()->json(['assignment'=>Assignement::create($request->validated())]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->authorize('view',Assignement::class);
        return response()->json(['assignment'=>Assignement::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\Assignment\AssignmentUpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AssignmentUpdateRequest $request, $id)
    {
        $this->authorize('update',Assignement::class);
        $assignment=Assignement::find($id);
        $assignment->update($request->validated());
        return response()->json(['assignment'=>$assignment]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('delete',Assignement::class);
        return Assignement::destroy($id);
    }

    /**
     * Copy the specified resource from storage.
     * 
     * @param int $id
     * @param App\Http\Requests\Assignment\AssignmentCopyRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function copy(AssignmentCopyRequest $request,$id)
    {
        $this->authorize('create',Assignement::class);
        $assign=Assignement::find($id);
        return response()->json(['assignment'=>Assignement::create([
        'title'=>$assign['title'],
        'description'=>$assign['description'],
        'group_id'=> $request->input('group_id')
        ])]);
    }
}
