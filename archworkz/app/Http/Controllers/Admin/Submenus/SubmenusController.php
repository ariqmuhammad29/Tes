<?php

namespace App\Http\Controllers\Admin\Submenus;

use App\Http\Controllers\Controller;
use App\Models\Submenu;
use App\Models\Menu;
use Illuminate\Http\Request;

class SubmenusController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:submenus read');
        $this->middleware('permission:submenus create')->only('create', 'store');
        $this->middleware('permission:submenus update')->only('edit', 'update');
        $this->middleware('permission:submenus delete')->only('destroy');

        view()->share('menuActive', 'landing-page');
        view()->share('subMenuActive', 'submenus');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Submenu::orderBy('id')->paginate(10);
        return view('admin.submenu.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menu = Menu::get();
        return view('admin.submenu.create', compact('menu'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Submenu::create($request->all());
        return redirect()
            ->route('admin.submenus.update')
            ->with(['status' => 'success', 'message' => 'Save Successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Submenu  $submenu
     * @return \Illuminate\Http\Response
     */
    public function show(Submenu $submenu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Submenu  $submenu
     * @return \Illuminate\Http\Response
     */
    public function edit(Submenu $submenu)
    {
        $menu = Menu::orderBy('id')->get();
        return view('admin.submenu.edit', compact('submenu','menu'));   
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Submenu  $submenu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Submenu $submenu)
    {
        $request->validate([
            'title' => ['required'],
            'link' => ['required'],
            'status' => ['required']
        ]);

        Submenu::where('id', (string)$submenu->id)
            ->update([
                'title'     =>  $request->title,
                'link'      =>  $request->link,
                'parents'   =>  $request->parents,
                'status'    =>  $request->status
            ]);   
         
        return redirect()
        ->route('admin.submenus.update')
        ->with(['status' => 'success', 'message' => 'Update Successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Submenu  $submenu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Submenu $submenu)
    {
        Submenu::destroy($submenu->id);
        return redirect()
            ->route('admin.submenus.update')
            ->with(['status' => 'danger', 'message' => 'Your data has been deleted!']);
    }
}
