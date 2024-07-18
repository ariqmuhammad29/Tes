<?php

namespace App\Http\Controllers\Admin\Jam;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Jam;

class JamController extends Controller
{

    public function __construct() {
        $this->middleware('permission:jam read');
        $this->middleware('permission:jam create')->only('create', 'store');
        $this->middleware('permission:jam update')->only('edit', 'update');
        $this->middleware('permission:jam delete')->only('destroy');

        view()->share('menuActive', 'tamu');
        view()->share('subMenuActive', 'jam');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['models'] = jam::orderBy('id', 'desc')->paginate(10);

        return view('admin.jam.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.jam.create');
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
            'title' => 'required|max:500'
        ]);
        
        $jam = new Jam($request->all());
        $jam->save();

        return redirect()
            ->route('admin.jam.index')
            ->with([
                'message' => 'Save Successfully'
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
     * @param  jam  $jam
     * @return \Illuminate\Http\Response
     */
    public function edit(jam $jam)
    {
        return view('admin.jam.edit', ['model' => $jam]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  jam  $jam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, jam $jam)
    {
        $request->validate([
            'title' => 'required|max:500'
        ]);
    
        if ($jam->update($request->all())) {
            return redirect()->route('admin.jam.index')->with(['status' => 'success', 'message' => 'Update Successfully']);
        }

        return redirect()->route('admin.jam.edit', $jam->id)->with(['status' => 'danger', 'message' => 'Update Failed, Contact Developer']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  jam $jam
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(jam $jam)
    {
        if ($jam->delete()) {
            return redirect()->route('admin.jam.index')->with(['status' => 'success', 'message' => 'Delete Successfully']);
        }
        return redirect()->route('admin.jam.index')->with(['status' => 'danger', 'message' => 'Delete Failed, Contact Developer']);
    }
}
