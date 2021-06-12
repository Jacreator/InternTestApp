<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $authUser = auth()->user();

        if (is_null($authUser)) {
            return response()->json(
                ['success' => false, 'message' => 'No user found'],
                400);
        }

        return response()->json(
            ['success' => true, 'user' => $authUser],
            200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user = Auth()->user();
        // set rules
        $rules = [
            'email' => 'email|unique:users,email,' . $user->id,
            'password' => 'min:8|confirmed',
            
        ];

        $this->validate($request, $rules);

        // check individually what may have been sent
        // name check and update
        if ($request->has('name')) {
            $user->name = $request->name;
        }

        // email check and update verified, verification_token and email
        if ($request->has('email') && $request->email !== $user->email) {
            $user->verified = User::UNVERIFIED_USER;
            $user->verification_token = User::generateVerificationCode();
            $user->email = $request->email;
        }

        // password check
        if ($request->has('password')) {
            $user->password = bcrypt($request->password);
        }

        // check if any value was changed
        if (!$user->isDirty()) {
            return response()->json(
            ['success' => false, 'message' => 'You need to specify at least one different value to update'], 422);
        }

        // save user information
        $user->save();

        return response()->json(
            ['success' => true, 'user' => $user],
            201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user = Auth()->user();
        $user->delete();

       return response()->json(
            ['success' => true, 'user' => $user],
            201);
    }
}
