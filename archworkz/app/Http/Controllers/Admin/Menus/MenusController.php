<?php

namespace App\Http\Controllers\Admin\Menus;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenusController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:menus read');
        $this->middleware('permission:menus create')->only('create', 'store');
        $this->middleware('permission:menus update')->only('edit', 'update');
        $this->middleware('permission:menus delete')->only('destroy');

        view()->share('menuActive', 'landing-page');
        view()->share('subMenuActive', 'menus');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Menu::orderBy('id')->paginate(10);
        return view('admin.menu.index', compact('data'));
        // return 'vieriiii';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.menu.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Menu::create([
        //     'title'     => $request->title,
        //     'link'     => $request->link,
        //     'status'     => $request->status
        // ]);

        Menu::create($request->all());
        return redirect()
            ->route('admin.menus.update')
            ->with(['status' => 'success', 'message' => 'Save Successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        return view('admin.menu.edit', compact('menu'));   
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'title' => ['required'],
            'link' => ['required'],
            'status' => ['required']
        ]);

        
        Menu::where('id', (string)$menu->id)
            ->update([
                'title'     =>  $request->title,
                'link'      =>  $request->link,
                'status'    =>  $request->status
            ]);   
         
        return redirect()
        ->route('admin.menus.update')
        ->with(['status' => 'success', 'message' => 'Update Successfully']);
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        Menu::destroy($menu->id);
        return redirect()
            ->route('admin.menus.update')
            ->with(['status' => 'danger', 'message' => 'Your data has been deleted!']);
    }
}
