<?php

namespace App\Http\Controllers\Admin\Footer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\footer;
use Illuminate\Support\Facades\Storage;

class FooterController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:footer read');
        $this->middleware('permission:footer create')->only('create', 'store');
        $this->middleware('permission:footer update')->only('edit', 'update');
        $this->middleware('permission:footer delete')->only('destroy');

        view()->share('menuActive', 'footer');
        view()->share('subMenuActive', 'footer_info');
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
     * @param  footer  $footer
     * @return \Illuminate\Http\Response
     */
    public function edit(footer $footer)
    {
        $data  = footer::first();
        return view('admin.footer.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  footer  $footer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, footer $footer)
    {
        $request->validate([
            'location'           => 'required|max:250',
            'phone_number'     => 'required',
            'company_number'    => 'required',
            'website'           => 'required'
        ]);

        $footer = footer::first();
        if ($footer) {
            $footer->update($request->only('location', 'phone_number', 'company_number', 'website'));
        } else {
            $footer = new footer($request->only('location', 'phone_number', 'company_number', 'website'));
            $footer->save();
        }


        return redirect()->route('admin.footer.edit')->with(['status' => 'success', 'message' => 'Update Successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  footer $footer
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(footer $footer)
    {

        // if ($footer->delete()) {
        //     return redirect()->route('admin.footer.index')->with(['status' => 'success', 'message' => 'Delete Successfully']);
        // }

        // return redirect()->route('admin.footer.index')->with(['status' => 'danger', 'message' => 'Delete Failed, Contact Developer']);
    }
}
