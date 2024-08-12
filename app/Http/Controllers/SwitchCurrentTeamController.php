<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SwitchCurrentTeamController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $team = Team::query()->find($request->team_id);

        Auth::user()->switchTeam($team);

        return redirect()->back();
    }
}
