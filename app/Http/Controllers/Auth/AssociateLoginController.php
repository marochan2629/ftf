<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssociateLoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::ASSOCIATE_HOME;

    public function __construct()
    {
        $this->middleware('guest:associate')->except('logout');
    }

    protected function guard()
    {
        return Auth::guard('associate');
    }

    public function showLoginForm()
    {
        session(['url.intended' => url()->previous()]);
        return view('associate.auth.login');
    }

    public function logout(Request $request)
    {
        Auth::guard('associate')->logout();

        return $this->loggedOut($request);
    }

    public function loggedOut(Request $request)
    {
        return redirect(route('associate.login'));
    }
}