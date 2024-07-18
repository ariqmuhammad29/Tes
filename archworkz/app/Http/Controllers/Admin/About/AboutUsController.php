<?php

namespace App\Http\Controllers\Admin\About;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\about;
use Illuminate\Support\Facades\Storage;

class AboutUsController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:abouts read');
        $this->middleware('permission:abouts create')->only('create', 'store');
        $this->middleware('permission:abouts update')->only('edit', 'update');
        $this->middleware('permission:abouts delete')->only('destroy');

        view()->share('menuActive', 'landing-page');
        view()->share('subMenuActive', 'abouts');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $data['models'] = about::orderBy('id', 'desc')->paginate(10);
        // return view('admin.abouts.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('admin.abouts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'title'           => 'required|max:250',
        //     'description'     => 'required',
        // ]);

        // $about = new about($request->all());


        // $about->save();

        // return redirect()
        //     ->route('admin.about.index')
        //     ->with(['status' => 'success', 'message' => 'Save Successfully']);
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
     * @param  about  $about
     * @return \Illuminate\Http\Response
     */
    public function edit(about $about)
    {
        $data  = about::first();
        return view('admin.abouts.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  about  $about
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, about $about)
    {
        $request->validate([
            'title'           => 'required|max:250',
            'description'     => 'required',
        ]);

        $about = about::first();
        if ($about) {
            $about->update($request->only('title', 'description'));
        } else {
            $about = new about($request->only('title', 'description'));
            $about->save();
        }
        

        return redirect()->route('admin.about.edit')->with(['status' => 'success', 'message' => 'Update Successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  about $about
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(about $about)
    {

        // if ($about->delete()) {
        //     return redirect()->route('admin.about.index')->with(['status' => 'success', 'message' => 'Delete Successfully']);
        // }

        // return redirect()->route('admin.about.index')->with(['status' => 'danger', 'message' => 'Delete Failed, Contact Developer']);
    }
}
