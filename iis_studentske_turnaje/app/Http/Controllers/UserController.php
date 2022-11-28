<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //Show all users
    public function index()
    {
        return view('users.index', 
        [
            'users' => User::latest()->filter(request(['search']))->paginate(),
        ]);
    }
    
    // Show Register/Create form
    public function create()
    {
        return view('users.register');
    }

    // Create new user
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'confirmed', 'min:6']
        ]);

        // Hash password
        $formFields['password'] = bcrypt($formFields['password']);

        // Create user
        $user = User::create($formFields);

        // Login
        auth()->login($user);
        
        return redirect('/')->with('message', 'User created and logged in');
    }

    // Log user out
    public function logout(Request $request){
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'You have been logged out!');
    }

    // show login form
    public function login(){
        return view('users.login');
    }

    // authenticate user
    public function authenticate(Request $request){
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);

        if (auth()->attempt($formFields)){
            $request->session()->regenerate();

            return redirect('/')->with('message', 'You have been logged in!');
        }

        return back()->withErrors(['email' => 'Invalid Credentials'])->onlyInput('email');
    }

    // Show single user profile
    public function show(User $user){
        return view('users.show', [
            'user' => $user
        ]);
    }

    // Show Edit user profile
    public function edit(User $user){
        // Make sure logged in user is owner
        if ($user->id != auth()->id() && Auth::user()->role == 0) {
            abort(403, 'Unauthorized Action');
        }
        return view('users.edit', [
            'user' => $user
        ]);
    }

    // Store tournament data
    public function update(Request $request, User $user)
    {
        // Make sure logged in user is owner
        if ($user->id != auth()->id() && Auth::user()->role == 0) {
            abort(403, 'Unauthorized Action');
        }

        $formFields = $request->validate([
            'name' => 'required',
            'logo' => 'required',
            
        ]);

        $user->update($formFields);

        return back()->with('message', 'User profile updated succesfully.');
    }

    // Delete user profile
    public function destroy(Request $request, User $user){
        // Make sure logged in user is owner
        if ($user->id != auth()->id() && Auth::user()->role == 0) {
            abort(403, 'Unauthorized Action');
        }

        if ($user->id == auth()->id()) {
            auth()->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            $user->delete();

            return redirect('/')
            ->with('message', 'User has been deleted and logged out succesfully.');
        }
        else{
            $user->delete();

            return redirect()->back()
            ->with('message', 'User has been deleted succesfully.');
        }        
    }
}

