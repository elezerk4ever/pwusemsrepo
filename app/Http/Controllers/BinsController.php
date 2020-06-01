<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BinsController extends Controller
{
    public function index(){
        $this->authorize('viewAny',\App\Program::class);
        return view('bin.index');
    }
}
