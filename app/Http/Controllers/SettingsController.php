<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    public function index(){
        $this->authorize('viewAny',\App\Program::class);
        return view('settings.index');
    }
    public function update(Request $request,\App\User $user){
        $this->authorize('viewAny',\App\Program::class);
        $data = $this->validate($request,
        [
            'username'=>'required',
            'old_password'=>'required',
            'new_password'=>'required'
        ]);
        if(!Hash::check($data['old_password'],$user->password)){
            return back()->withError('wrong password!');
        }else {
            $user->update([
                'username'=>$data['username'],
                'password'=>Hash::make($data['new_password'])
            ]);
            return back()->withSuccess('Done!');
        }
    }
}
