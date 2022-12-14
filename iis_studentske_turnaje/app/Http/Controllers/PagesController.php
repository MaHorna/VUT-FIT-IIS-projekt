<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\User;
use App\Models\Tournament;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    // Show all listings
    public function index(Request $request)
    {
        $tournaments = Tournament::latest()->filter(request(['search']))->get();
        $users = User::latest()->filter(request(['search']))->get();
        $teams = Team::latest()->filter(request(['search']))->get();

        $tmp = "";
        if ($request->ajax())
        {
            $tournaments_HTML = [];
            $users_HTML = [];
            $teams_HTML = [];

            if (count($tournaments) == 0) {
                $tmp = "
                        <div class=\"bg-black border border-gray-200 rounded p-6\">
                            <p class=\"text-2xl mb-2\">No Tournaments found</p>
                        </div>
                        ";
                array_push($tournaments_HTML, $tmp);
            }
            else {
                foreach ($tournaments as $tournament)
                {
                    if ($tournament->teams_allowed)
                    {
                        $tmp = "
                        <div class=\"bg-black border border-gray-200 rounded p-6\">
                            <div class=\"flex text-white\">
                                <img
                                    class=\"hidden w-48 mr-6 md:block\"
                                    src=\"".asset('images/logos/' . $tournament->logo)."\"
                                    alt=\"\"
                                />
                                <div>
                                    <h3 class=\"text-2xl text-yellowish font-bold\">
                                        <a href=\"".url('/tournaments', $tournament->id)."\">".$tournament->name."</a>
                                    </h3>
                                    <div class=\"text-xl font-bold mb-4\">".$tournament->game."</div>
                                    <div class=\"text-0.5lg mb-4\">
                                        <i class=\"fa-solid fa-clock-four\"></i> ".$tournament->start_date."
                                    </div>
                                    <div class=\"text-0.5xl mb-4\">Status: ".$tournament->status."</div>
                                    <div class=\"text-0.5xl mb-4\">Type: Team vs Team</div>
                                </div>
                            </div>
                        </div>
                        ";
                    }
                    else
                    {
                        $tmp = "
                        <div class=\"bg-black border border-gray-200 rounded p-6\">
                            <div class=\"flex text-white\">
                                <img
                                    class=\"hidden w-48 mr-6 md:block\"
                                    src=\"".asset('images/logos/' . $tournament->logo)."\"
                                    alt=\"\"
                                />
                                <div>
                                    <h3 class=\"text-2xl text-yellowish font-bold\">
                                        <a href=\"".url('/tournaments', $tournament->id)."\">".$tournament->name."</a>
                                    </h3>
                                    <div class=\"text-xl font-bold mb-4\">".$tournament->game."</div>
                                    <div class=\"text-0.5lg mb-4\">
                                        <i class=\"fa-solid fa-clock-four\"></i> ".$tournament->start_date."
                                    </div>
                                    <div class=\"text-0.5xl mb-4\">Status: ".$tournament->status."</div>
                                    <div class=\"text-0.5xl mb-4\">Type: Player vs Player</div>
                                </div>
                            </div>
                        </div>
                        ";
                    }
                    array_push($tournaments_HTML, $tmp);
                }

            }

            if (count($teams) == 0) {
                $tmp = "
                        <div class=\"bg-black border border-gray-200 rounded p-6\">
                            <p class=\"text-2xl mb-2\">No Teams found</p>
                        </div>
                        ";
                array_push($teams_HTML, $tmp);
            }
            else {
                foreach ($teams as $team)
                {
                    $total_games = $team->lost_games + $team->won_games;
                    $win_rate = 0;
                    if ($total_games !== 0) {
                        $win_rate = ($team->won_games * 100) / $total_games;
                        
                    }

                    $tmp = "
                        <div class=\"bg-black border border-gray-200 rounded p-6\">
                            <div class=\"flex text-white\">
                                <img
                                    class=\"hidden w-48 mr-6 md:block\"
                                    src=\"".asset('images/logos/' . $team->logo)."\"
                                    alt=\"\"
                                />
                                <div>
                                    <h3 class=\"text-2xl font-bold text-yellowish\">
                                        <a href=\"".url('/teams', $team->id)."\">".$team->name."</a>

                                    </h3>
                                    <div class=\"text-xl mb-4\">Total games: ".$total_games."</div>
                                    <div class=\"text-0.5xl mb-4\">Won games: ".$team->won_games."</div>
                                    <div class=\"text-0.5xl mb-4\">Lost games: ".$team->lost_games."</div>
                                    <div class=\"text-0.5xl mb-4\">Win rate: ".round($win_rate, 2)."%</div>
                                </div>
                            </div>
                        </div>
                        ";
                        
                    array_push($teams_HTML, $tmp);
                }
            }

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

            return response()->json(['success' => 'IDE TO YAY!!!',
            'tournaments' => $tournaments_HTML,
            'users' => $users_HTML,
            'teams' => $teams_HTML]);
        }

        return view('pages.index', 
        [
            'tournaments' => $tournaments,
            'users' => $users,
            'teams' => $teams,
        ]);
    }
}
