<?php

namespace App\Http\Controllers\Website\Gallery;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\Product\PostProduct;
use App\Models\Product\Product_image;
use App\Models\Slider;
use Laravel\Ui\Presets\React;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        View()->share('menu', 'Gallery');
    }

    public function index()
    {
        $data['gallery'] = Gallery::take(12)->get();
        $data['product'] = PostProduct::all();
        $data['sliders'] = Slider::take(7)->get();
        return view('website.gallery.image.index', $data);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug, Request $request)
    {
        $data['model'] = PostProduct::where('slug', $slug)->first();
        $data['models'] = Product_image::where('product_id', $data['model']->id)->get();
        return view('website.gallery.image.show', $data);
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
