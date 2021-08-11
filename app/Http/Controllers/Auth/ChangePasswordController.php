<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class ChangePasswordController extends Controller
{
    public function index() {
        return view('auth.passwords.change');
    }

    public function changePassword(Request $request) {
        // echo "hai";
        // $oldpassword = $request->oldpassword;
        // $password = $request->password;
        
        // return $request->all();
        $this->validate($request, [
            'oldpassword' => 'required',
            'password' => 'required|string|min:8|confirmed'
        ]);
        $hashedPassword = Auth::user()->password;
        // return $hashedPassword;
        if(Hash::check($request->oldpassword, $hashedPassword)) {
            $user = User::find(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();
            return redirect()->route('login')->with('success', 'Password has been updated successfully!');
        }
        else {
            return redirect()->route('password.change')->with('error', 'Current Password is not valid.');
        }
        
    }
    
}
