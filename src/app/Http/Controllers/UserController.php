<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        //
        $fields = $request->validate([
            'email' => 'required|string|email|unique:admins',
            'password' => 'required|string|min:5|confirmed',
            'password_confirmation' => 'required|string'
        ]);

        $user = new User();

        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        // $user->api_token = bin2hex(random_bytes(64));
        $result = $user->save();

        if($result) {
            $user->sendEmailVerificationNotification();
            // $user->markEmailAsVerified();
            $token = $user->createToken('token-name')->plainTextToken;
        }
        


        return $token;
        
    }

     public function email_verify(Request $request) {

        return $request;

    }

    public function test() {

        return "you are authenticated!!";

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}