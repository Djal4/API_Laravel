<?php

namespace App\Http\Controllers;

use App\Http\Requests\Review\ReviewStoreRequest;
use App\Http\Requests\Review\ReviewUpdateRequest;
use App\Models\Review;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Review::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Request\Review\ReviewStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReviewStoreRequest $request)
    {
        return Review::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Review::find($id);
    }

    /**
     * Display the specified intern's reviews.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showIntern($id)
    {
        return DB::table('reviews')
            ->where('intern_id','=',$id)
            ->orderBy('date_reviewed','asc');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Request\Review\ReviewUpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ReviewUpdateRequest $request, $id)
    {
        $review=Review::find($id);
        $review->update($request->all());
        return $review;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Review::destroy($id);
    }
}
