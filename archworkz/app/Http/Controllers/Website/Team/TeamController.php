<?php

namespace App\Http\Controllers\Website\Team;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Support\Facades\View;

class TeamController extends Controller
{
    public function __construct()
    {
        view::share('recenrPosts', Team::latest()->limit(2)->get());
        view()->share('menu', 'Team');
    }
    /**
     * Display a listing of the resource.
     *
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['team']   = Team::all();
        return view('website.team.index', $data);
    }
    public function show($slug)
    {
        $data['model'] = Team::where('slug', $slug)->first();
        return view('website.team.show', $data);
    }
}
