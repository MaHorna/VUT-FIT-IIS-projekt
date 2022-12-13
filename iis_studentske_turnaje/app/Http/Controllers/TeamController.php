<?php

namespace App\Http\Controllers;


use App\Models\Team;
use App\Models\User;
use App\Models\Teamuser;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TeamController extends Controller
{
    // Show all teams
    public function index()
    {
        return view('teams.index', 
        [
            'teams' => Team::latest()->filter(request(['search']))->paginate(),
        ]);
    }

    // Show single team
    public function show(Team $team)
    {
        $team_users = null;
        if (Auth::check()) {
            $team_users = DB::table('teams')
                ->join('teamusers', 'teamusers.team_id', '=', 'teams.id')  
                ->join('users','teamusers.user_id', '=', 'users.id')
                ->where('teams.id',$team->id)
                ->get();

        }
        return view('teams.show', 
        [
            'team_users' => $team_users,
            'team' => $team,
            'users' => User::latest()->filter(request(['search']))->get(),
        ]); 

    }

    // Show create team form
    public function create()
    {
        return view('teams.create');
    }

    // Store team data
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'name' => ['required', Rule::unique('teams', 'name')],
            'logo' => 'required',
        ]);

        $formFields['user_id'] = auth()->id();
        $formFields['description'] = $request['description'];

        Team::create($formFields);

        return redirect('/')->with('message', 'Team created succesfully.');
    }

    // Show Edit team form
    public function edit(Team $team){
        return view('teams.edit', ['team' => $team]);
    }

    // Store team data
    public function update(Request $request, Team $team)
    {
        $formFields = $request->validate([
            'name' => ['required'],
            'logo' => 'required',
        ]);

        $formFields['description'] = $request['description'];

        $team->update($formFields);

        return response()->json(['success'=>'Data is successfully added', 
        'name' => $team->name, 
        'logo' => asset('images/logos/'. $team->logo), 
        'description' => $team->description]);
        //return redirect('/')->with('message', 'Team updated succesfully.');
    }

    // Delete team
    public function destroy(Team $team){
        $team->delete();

        return redirect('/')
            ->with('message', 'Team deleted succesfully.');
    }

    // Add user
    public function add_user(Request $request)
    {
        $formFields = $request->validate([
            'user_id' => ['required'],
            'team_id' => ['required'],
        ]);
        Teamuser::create($formFields);

        if (Auth::check()) {
            $team_users = DB::table('teams')
                ->join('teamusers', 'teamusers.team_id', '=', 'teams.id')  
                ->join('users','teamusers.user_id', '=', 'users.id')
                ->where('teams.id',$request->team_id)
                ->where('users.id', $request->user_id)
                ->first();

        }

        $addPlayer = "<div id=\"div".$request->team_id."a". $request->user_id."\"> 
        <div class=\"flex\">
            <div class=\"mr-2\">
                <span>".$team_users->name."</span>
            </div>
            <div>
                    <form>
                        <button id=\"remove".$request->team_id ."a". $request->user_id."\" class=\"removePlayer text-red-500\"><i class=\"fa-solid fa-x\"></i></button>
                    </form>
            </div>
        </div>
        <script>
            $(\"#remove".$request->team_id ."a" . $request->user_id."\").click(function(e)
            {
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name=\"csrf-token\"]').attr('content')
                    }
                });
                jQuery.ajax({
                    url: \"".url('/my_teams/destroy/'. $request->user_id . '/'. $request->team_id)."\",
                    method: 'DELETE',
                    data: {
                    },
                    success: function(data){
                        const tmp = document.getElementById(data.delete);
                        tmp.remove();
                    }});
            });
        </script>
    </div>";


        return response()->json(['success'=>'Data is successfully added',
        'addPlayer' => $addPlayer,
        'delete' =>'option'.$request->team_id .'a'. $request->user_id ]);
    }
    
    // Delete user
    public function remove_user($user_id,  $team_id){
        $deleted = Teamuser::where('user_id', $user_id)->where('team_id', $team_id)->delete();
        
        return response()->json(['success'=>'Data is successfully added',
        'delete' => 'div'.$team_id .'a'. $user_id]);
        return back()->with('message', 'player removed succesfully.');
    }
    

}
