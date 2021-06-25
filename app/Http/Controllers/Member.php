<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\contacts;

class Member extends Controller
{
    function show(){

        //return view('emailTrack');
        $data= contacts::all();
        return view('emailTrack',['contacts'=>$data]);
    }
}
