<?php

namespace App\Http\Controllers\Admin\Team;

use App\Models\Team;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class TeamController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:teams read');
        $this->middleware('permission:teams create')->only('create', 'store');
        $this->middleware('permission:teams update')->only('edit', 'update');
        $this->middleware('permission:teams delete')->only('destroy');

        view()->share('menuActive', 'team');
        view()->share('subMenuActive', 'teams');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teams = Team::ordered()->paginate(10);

        return view('admin.teams.index', compact('teams'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.teams.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'role' => ['required'],
            'about' => ['required'],
            'image' => ['required', 'file', 'mimes:png,jpg,jpeg'],
        ]);


        $payload = $request->all();
        // $payload['social_media'] = json_encode($request->accounts);

        $team = new Team($payload);

        $image = $team->uploadImage($request->file('image'), 'ugc/teams');

        $team->image = $image->lg;
        $team->save();

        return redirect()->route('admin.teams.index')->with([
            'status' => 'success',
            'message' => 'New team has been stored :)'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Models\Team
     * @return \Illuminate\Http\Response
     */
    public function edit(Team $team)
    {
        return view('admin.teams.edit', compact('team'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Team $team)
    {
        $request->validate([
            'name' => ['required'],
            'role' => ['required'],
            'about' => ['required'],
            'image' => ['file', 'mimes:png,jpg,jpeg'],
        ]);

        $payload = $request->all();

        if ($request->hasFile('image')) {
            $newImage = $team->uploadImage($request->file('image'), 'ugc/teams');

            # hapus foto lama
            if (@$newImage) {
                $team->deleteImage(@$team->image->path);
                $payload['image'] = $newImage->lg;
            }
        }

        $team->update($payload);

        return redirect()->route('admin.teams.index')->with([
            'status' => 'success',
            'message' => 'Team has been updated :)'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Team $team)
    {
        Storage::delete($team->image->path);
        $team->delete();

        return redirect()->route('admin.teams.index')->with([
            'status' => 'success',
            'message' => 'Team has been deleted'
        ]);
    }
}
