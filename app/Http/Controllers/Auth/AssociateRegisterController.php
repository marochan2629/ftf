<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use App\Models\Associate;

class AssociateRegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = RouteServiceProvider::ASSOCIATE_HOME;

    public function __construct()
    {
        $this->middleware('guest:associate');
    }

    // Guardの認証方法を指定
    protected function guard()
    {
        return Auth::guard('associate');
    }

    // 新規登録画面
    public function showRegistrationForm()
    {
        return view('associate.auth.register');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:associates'],
            'age' => ['required', 'integer', 'between:0, 120'],
            'religion_id' => ['required', 'integer'],
            'country' => ['required', 'integer'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function create(array $data)
    {
        return Associate::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'age' => $data['age'],
            'religion_id' => $data['religion_id'],
            'country' => $data['country'],
            'password' => Hash::make($data['password']),
        ]);
    }

    // protected function create(array $data)
    // {
    //     return User::create([
    //         'name' => $data['name'],
    //         'email' => $data['email'],
    //         'age' => $data['age'],
    //         'password' => Hash::make($data['password']),
    //     ]);
    // }
}