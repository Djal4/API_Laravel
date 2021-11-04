<?php

namespace App\Http\Controllers;

use App\Http\Requests\Intern\InternStoreRequest;
use App\Http\Requests\Intern\InternUpdateRequest;
use App\Models\Intern;

class InternController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Intern::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Request\InternStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(InternStoreRequest $request)
    {
        return Intern::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Intern::find($id);
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
        $intern->update($request->all());
        return $intern;        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Intern::destroy($id); 
    }
}
