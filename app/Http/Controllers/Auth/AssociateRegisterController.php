<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\Associate;
use App\Models\Religion;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class AssociateRegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    // use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest:associate');
        $this->religion = new Religion();
    }

    protected function showAssociateRegistrationForm()
    {
        $religions = $this->religion->get();
        return view('associates.register', compact('religions'));
    }

    protected function validatorAssociate(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'age' => ['required', 'integer', 'between:0,150'],
            'religion_id' => ['required', 'integer'],
            'country' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function register(Request $request)
    {
        $this->validatorAssociate($request->all())->validate();
        $associate = Associate::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'age' => $request['age'],
            'religion_id' => $request['religion_id'],
            'country' => $request['country'],
            'password' => Hash::make($request['password']),
        ]);
        // $this->redirectTo = route('/home');

        // $associate = new Associate;
        // $form = $request->all();
        // unset($form['_token']);
        // $associate->fill($form)->save();
        // return redirect('/associate');

    }
}
