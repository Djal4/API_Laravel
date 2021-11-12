<?php

namespace App\Http\Controllers;

use App\Http\Requests\Review\ReviewStoreRequest;
use App\Http\Requests\Review\ReviewUpdateRequest;
use App\Models\Review;
use App\Models\User;
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
        $user=User::get();
        $this->authorize('viewAny',Review::class);
        if($user->roles_id==1)
            return Review::where('mentor_id',$user->id)->get();
        else
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
        $this->authorize('create',Review::class);
        return Review::create($request->validated());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->authorize('view',Review::class);
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
        $this->authorize('view',Review::class);
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
        $this->authorize('update',Review::class);
        $review=Review::find($id);
        $review->update($request->validated());
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
        $this->authorize('delete',Review::class);
        return Review::destroy($id);
    }
}
