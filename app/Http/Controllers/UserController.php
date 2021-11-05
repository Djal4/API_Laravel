<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\User\UserUpdateRequest;
use App\Http\Requests\User\UserStoreRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\User\UserStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreRequest $request)
    {
        return User::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return User::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\UserStoreRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, $id)
    {
        $user= User::find($id);
        $user->update($request->all());
        return $user;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return User::destroy($id);
    }

    /**
     * Log into system.
     * 
     * @param \Illuminate\Http\Request $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function logIn(Request $request)
    {
        $credentials = $request->validate([
            'mail' => 'required',
            'password' => 'required'
        ]);
        
        $user=User::where('mail',$credentials['mail'])->first();
        if(!$user || $user->password!=$credentials['password']){
            return response(['Message'=>'Bad Credentials']);
        }else{
            $token=$user->createToken('token');
            return response([
                'user' => $user,
                'auth_token' => $token
            ]);
        }
    }
}
