<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use App\User;

class UserController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return $this->showAll($users);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return $this->showOne($user);
    }

    public function store(Request $request){

        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed'
        ];

        $this->validate($request, $rules);

        $data = $request->all();

        $data['password'] = bcrypt($request->password);
        $data['verified'] = User::UNVERIFIED_USER;
        $data['verification_token'] = User::generateVerificationCode();
        $data['admin'] = User::REGULAR_USER;

        $user = User::create($data);

        return response()->json(['data' => $user], 200);

    }

    public function update(Request $request, User $user){

        $rules = [
            'email' => 'required|email|unique:users,email'.$user->id,
            'password' => 'required|min:6|confirmed',
            'admin' => 'in:'. User::ADMIN_USER.','.USER::REGULAR_USER,
        ];

        $this->validate($request, $rules);


        if($request->has('name')){
            $user->name = $request->name;
        }

        if($request->has('email') && $user->email != $request->email){
            $user->email = $request->email;
            $user->verified = User::UNVERIFIED_USER;
            $user->verification_token = User::generateVerificationCode();

        }

        if($request->has('password')){
            $user->password = bcrypt($request->password);
        }

        if($request->has('admin')){
            if(!$user->isVerified()){
                return $this->errorResponse('Only verified users can modify the admin',409);
            }

            $user->admin = $request->admin;
        }


        if(!$user->isDirty()){
            return $this->errorResponse('You Need to Specify a different value to update', 422);
        }

        $user->save();

        return response()->json(['message' => 'Successfully to Update Data User'], 200);

    }

    public function destroy(User $user){
        $user->delete();

        return response()->json([
            'data' => $user
        ],200);
    }

}
