<?php

namespace App\Http\Controllers\Website\Portofolio;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Portofolio\Portofolio;
use Illuminate\Support\Facades\View;

class PortofolioController extends Controller
{
    public function __construct()
    {
        View()->share('menu', 'Portofolio');
    }

    /**
     * Display a listing of the resource.
     *
     * @param string $slug
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['portofolio']    = Portofolio::orderby('id', 'desc')->paginate(8);
        return view('website.portofolio.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
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
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $data['portofolio'] = Portofolio::where('slug', $slug)->first();
        return view('website.portofolio.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
