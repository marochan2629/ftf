<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Associate;

class AssociateController extends Controller
{
    public function home() {
        return view('associate.home');
    }
}
