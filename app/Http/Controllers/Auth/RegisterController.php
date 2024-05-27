<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(RegisterRequest $request)
    {
        $request->validated();
        $credentials = $request->only('user_name', 'password');
        $user = $this->create($credentials);
        return redirect()->route('login');
    }


    protected function create(array $data)
    {
        return User::create([
            'user_name' => $data['user_name'],
            'password' => Hash::make($data['password'])
        ]);
    }
}
