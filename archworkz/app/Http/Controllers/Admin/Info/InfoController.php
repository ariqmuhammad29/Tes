<?php

namespace App\Http\Controllers\Admin\Info;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Info;
use Illuminate\Support\Facades\Storage;

class InfoController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:info read');
        $this->middleware('permission:info create')->only('create', 'store');
        $this->middleware('permission:info update')->only('edit', 'update');
        $this->middleware('permission:info delete')->only('destroy');

        view()->share('menuActive', 'team');
        view()->share('subMenuActive', 'info');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
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
     * @param  info $info
     * @return \Illuminate\Http\Response
     */
    public function edit(info $info)
    {
        $data  = Info::first();
        return view('admin.info.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  info  $info
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, info $info)
    {
        $request->validate([
            'description'     => 'required',
        ]);

        $info =Info::first();
        if ($info) {
            $info->update($request->only('description'));
        } else {
            $info = new Info($request->only('description'));
            $info->save();
        }
        

        return redirect()->route('admin.info.edit')->with(['status' => 'success', 'message' => 'Update Successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  info $info
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(info $info)
    {

     
    }
}
