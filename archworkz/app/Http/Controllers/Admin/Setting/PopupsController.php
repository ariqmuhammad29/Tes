<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Models\Popup;
use Illuminate\Http\Request;

class PopupsController extends Controller
{
    public function __construct()
    {
        view()->share('menuActive', 'settings');
        view()->share('subMenuActive', 'popup');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $popup = Popup::orderBy('id')->paginate(10);
        return view('admin.settings.popup.index', compact('popup'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Popup  $popup
     * @return \Illuminate\Http\Response
     */
    public function show(Popup $popup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Popup  $popup
     * @return \Illuminate\Http\Response
     */
    public function edit(Popup $popup)
    {
        return view('admin.settings.popup.edit', compact('popup'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Popup  $popup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Popup $popup)
    {
        $request->validate([
            'title' => ['required'],
            'description' => ['required'],
            'url' => ['required'],
            'type' => ['required'],
            'status' => ['required'],
        ]);

        Popup::where('id', $popup->id)
            ->update([
                'title'         =>  $request->title,
                'description'   =>  $request->description,
                'url'           =>  $request->url,
                'type'        =>  $request->type,
                'status'        =>  $request->status
            ]);
        return redirect('/admin-panel/settings/popup/1/edit')->with([
            'success' => 'Item telah diperbarui'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Popup  $popup
     * @return \Illuminate\Http\Response
     */
    public function destroy(Popup $popup)
    {
        //
    }
}
