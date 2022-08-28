<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Associate;
use Illuminate\Validation\Rule;

class AssociateHomeController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth:associate');
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('associate.home');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $auth_associate = Auth::guard('associate')->user();
        $associate = Associate::findOrFail($id);

        return view('app.associate_mypage', compact('associate', 'auth_associate'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('associates')->ignore($id)],
            'age' => ['required', 'integer', 'between:0, 130'],
            'religion' => ['string'],
            'country' => ['string'],
        ]);

        $name = $request->name;
        $email = $request->email;
        $age = $request->age;
        $religion = $request->religion;
        $country = $request->country;

        Associate::where('id', $id)->update([
            'name' => $name,
            'email' => $email,
            'age' => $age,
            'religion' => $religion,
            'country' => $country,
        ]);

        return redirect()->route('associate.mypage', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
