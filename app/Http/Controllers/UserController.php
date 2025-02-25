<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Pest\Plugins\Only;

class UserController extends Controller
{
    protected $guard = [''];

    public function store(StoreUserRequest $request)
    {
        // dd($request->all());
        $validatedData = $request->validated();
       $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role]);
        session()->flash('success', 'You have successfully registered');
        return redirect()->route('register');
    }
    
    public function login(Request $request)
    {
        // If the user is already logged in, redirect them to the home page
        if (Auth::check()) {
            return redirect()->route('index'); // Redirect to the home page (or dashboard)
        }
    
        // Validate the login form data
        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        // Attempt to log the user in
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            session()->flash('success', 'You have successfully logged in!'); 
            return redirect()->route('index');
        } else {
            return redirect()->route('loginPage')->withErrors(['email' => 'Wrong email or password']);
        }
        
    }
    

    public function logout()
    {
        Auth::logout();
        
        session()->flush();
        session()->flash('success', 'You have successfully logged out!'); 
        return redirect()->route('loginPage');
    }

}