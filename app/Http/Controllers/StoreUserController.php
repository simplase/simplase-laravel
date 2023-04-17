<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StoreUserController extends Controller
{
    public function __invoke(Request $request)
    {
        $data = $request->validate(
            [
                'name' => 'required|string',
                'email' => 'required|email',
                'password' => 'required|string|confirmed',
                'password_confirmation' => 'required|string',
            ]
        );

        $data['password'] = Hash::make($data['password']);
        $user = User::firstOrCreate([
            'email' => $data['password']
        ], $data);

        $token = auth()->login($user);

        return response($token, 200)->header('Content-Type', 'text/plain');
    }
}
