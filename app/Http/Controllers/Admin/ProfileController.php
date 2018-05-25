<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $user = Auth::user();
        return view('admin/profile',  compact('user'));
    }
    
    public function update(User $user, Request $request){
      
        $data = $request->validate([
        'name' => 'required',
        'email' => 'unique:users,email,'.$user->id.',id',
       // 'password' => 'required|confirmed|min:6',
    ]);
        $user->name = request('name');
        $user->email = request('email');
        $user->password = bcrypt(request('password'));
        $user->save();

    return redirect('admin/dashboard')->with('key', 'You have done successfully');
        
    }
}