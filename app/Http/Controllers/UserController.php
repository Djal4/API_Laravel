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
    public function getUsr()
    {
        $headers=apache_request_headers();
        $token=explode(' ',$headers['Authorization']);
        return User::where('remember_token',$token[1])->first();
    }
    public function index()
    {
        $this->authorize('viewAny',User::class);
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
        $this->authorize('create',User::class);
        $usr=$this->getUsr();
        if($usr->roles_id==2 && $request->input('roles_id')!=1)
            return response(['Error'=>'No permission.'],403);
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
        $this->authorize('view',User::class);
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
        $this->authorize('update',User::class);
        $usr=$this->getUsr();
        $user= User::find($id);
        if($usr->roles_id==2 && ($request->input('roles_id')!=1 || $user['roles_id']>1))
            return response(['Error'=>'No permission.'],403);
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
        $this->authorize('delete',User::class);
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
            $token=$user->createToken('token')->plainTextToken;
            $user->remember_Token=$token;
            $user->save();
            return response([
                'user' => $user,
                'auth_token' => $token
            ]);
        }
    }
}
