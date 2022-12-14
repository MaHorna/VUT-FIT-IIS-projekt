<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //Show all users
    public function index(Request $request)
    {
        $users = User::latest()->filter(request(['search']))->get();

        $tmp = "";
        if ($request->ajax())
        {
            $users_HTML = [];

            if (count($users) == 0) {
                $tmp = "
                        <div class=\"bg-black border border-gray-200 rounded p-6\">
                            <p class=\"text-2xl mb-2\">No Users found</p>
                        </div>
                        ";
                array_push($users_HTML, $tmp);
            }
            else {
                foreach ($users as $user)
                {
                    $total_games = $user->lost_games + $user->won_games;
                    $win_rate = 0;
                    if ($total_games !== 0) {
                        $win_rate = ($user->won_games * 100) / $total_games;
                    }
                    
                    $tmp = "
                        <div class=\"bg-black border border-gray-200 rounded p-6\">
                            <div class=\"flex text-white\">
                                <img
                                    class=\"hidden w-48 mr-6 md:block\"
                                    src=\"".asset('images/logos/' . $user->logo)."\"
                                    alt=\"\"
                                />
                                <div>
                                    <h3 class=\"text-2xl font-bold text-yellowish\">
                                        <a href=\"".url('/users', $user->id)."\">".$user->name."</a>
                                    </h3>
                                    
                                    <div class=\"text-xl mb-4\">Total games: ".$total_games."</div>
                                    <div class=\"text-0.5xl mb-4\">Won games: ".$user->won_games."</div>
                                    <div class=\"text-0.5xl mb-4\">Lost games: ".$user->lost_games."</div>
                                    <div class=\"text-0.5xl mb-4\">Win rate: ".round($win_rate, 2)."%</div>
                                </div>
                            </div>
                        </div>
                        ";
                    array_push($users_HTML, $tmp);
                }
            }

            return response()->json(['users' => $users_HTML]);
        }

        return view('users.index', 
        [
            'users' => $users,
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

        return response()->json(['success'=>'User profile updated succesfully.', 
        'user' => $user->name, 
        'logo' => asset('images/logos/'. $user->logo)]);
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

