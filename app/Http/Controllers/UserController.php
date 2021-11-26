<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\User\UserUpdateRequest;
use App\Http\Requests\User\UserStoreRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny',User::class);
        return response()->json(['users'=>User::all()]);
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
        $usr=User::get();
        if($usr->roles_id==2 && $request->input('roles_id')!=1)
            return response(['Error'=>'No permission.'],403);
        return response()->json(['user'=>User::create([
            'name'=>$request->input('name'),
            'lastname'=>$request->input('lastname'),
            'mail'=>$request->input('mail'),
            'skype'=>$request->input('skype'),
            'roles_id'=>$request->input('roles_id'),
            'password'=>Hash::make($request->input('password'))
        ])]);
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
        return response()->json(['user'=>User::find($id)]);
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
        $usr=User::get();
        $user= User::find($id);
        if($usr->roles_id==2 && ($request->input('roles_id')!=1 || $user['roles_id']>1))
            return response(['Error'=>'No permission.'],403);
        if(empty($request->input('password')))    
            $user->update($request->validated());
        else{
            $data=$request->except('password');
            $data['password']=Hash::make($request->password);
            $user->update($data);
        }
        return response()->json(['user'=>$user]);
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
        if(!$user || !Hash::check($credentials['password'],$user->password)){
            return response(['Message'=>'Bad Credentials']);
        }else{
            $token=$user->createToken('token')->plainTextToken;
            $user->remember_Token=$token;
            $user->save();
            return response()->json([
                'user' => $user,
                'auth_token' => $token
            ]);
        }
    }
}
