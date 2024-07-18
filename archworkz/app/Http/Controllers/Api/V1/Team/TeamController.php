<?php

namespace App\Http\Controllers\Api\V1\Team;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Team;

class TeamController extends Controller
{
    
    public function index()
    {
        $teams = Team::ordered()->get();

        return response()->json(compact('teams'));
    }
}
