<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class PostController extends Controller
{
    

    public function store (Request $request){
         dd($request->all());
    }

}
