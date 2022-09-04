<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Like;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UserHomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth:user');
    }

    public function index()
    {
        return view('user.home');
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
        $user = User::findOrFail($id);

        $likes = Like::where('user_id', $id)->get();
        $liked_articles = array();

        foreach($likes as $like)
        {
            array_push($liked_articles, Article::find($like['article_id']));
        }

        return view('app.mypage', compact('user', 'liked_articles'));
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
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($id)],
            'age' => ['required', 'integer', 'between:0, 130'],
            'religion' => ['string'],
            'country' => ['string'],
        ]);

        $name = $request->name;
        $email = $request->email;
        $age = $request->age;
        $religion = $request->religion;
        $country = $request->country;

        User::where('id', $id)->update([
            'name' => $name,
            'email' => $email,
            'age' => $age,
            'religion' => $religion,
            'country' => $country,
        ]);

        return redirect()->route('user.mypage', $id);
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

    public function mypage($id)
    {
        //
    }
}
