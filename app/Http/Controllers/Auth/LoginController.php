<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use LdapRecord\Laravel\Auth\ListensForLdapBindFailure;

class LoginController extends Controller
{
    use AuthenticatesUsers, ListensForLdapBindFailure;

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        $request->validated();
        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }
        return $this->sendFailedLoginResponse($request);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login');
    }

    protected function attemptLogin(Request $request)
    {
        $isLdap = $request->get('is_ldap') || false;
        if ($isLdap) {
            $credentials = [
                'uid' => $request->get('user_name'),
                'password' => $request->get('password'),
            ];
            $isCredentialValid = auth()->guard('webSessionWithLdap')->attempt($credentials);
            if (!$isCredentialValid) {
                $this->listenForLdapBindFailure($request);
            }
            return $isCredentialValid;
        } else {
            $credentials = $request->only('user_name', 'password');
            $isCredentialValid = auth()->guard('webSession')->attempt($credentials);
            return $isCredentialValid;
        }
    }

    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();
        Log::info('User logged in', ['user' => auth()->user()]);
        return redirect()->intended('dashboard');
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            'user_name' => [trans('auth.failed')],
        ]);
    }
}
