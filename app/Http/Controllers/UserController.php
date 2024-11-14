<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function update(Request $request): UserResource
    {
        $request->validate([
            'name' => 'string|max:255',
            'email' => 'string|email|max:255|unique:users,email,'.auth()->id(),
            'phone' => 'string|max:255',
            'password' => 'string|min:8',
            'avatar' => 'image',
        ]);
        /** @var User $user */
        $user = auth()->user();



        $user->name = $request->input('name', $user->name);
        $user->email = $request->input('email', $user->email);
        $user->phone = $request->input('phone', $user->phone);
        if($request->has('password')) {
            $user->password = Hash::make($request->input('password'));
        }

        if ($file = $request->file('avatar')) {
            $avatarPath = $file->store('avatars', 'public');
            $user->avatar = $avatarPath;
        }

        $user->save();

        return new UserResource($user->refresh());
    }

    public function get(): UserResource
    {
        return new UserResource(auth()->user());
    }
}
