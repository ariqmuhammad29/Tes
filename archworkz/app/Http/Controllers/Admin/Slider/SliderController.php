<?php

namespace App\Http\Controllers\Admin\Slider;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{

    /**
     * SliderController constructor.
     */
    public function __construct()
    {
        // $this->slider = new Slider(); # <-- iki gae opo, kan hanya digunakan di fungsi `store` tok?

        $this->middleware('permission:sliders read');
        $this->middleware('permission:sliders create')->only('create', 'store');
        $this->middleware('permission:sliders update')->only('edit', 'update');
        $this->middleware('permission:sliders delete')->only('destroy');

        view()->share('menuActive', 'product');
        view()->share('subMenuActive', 'sliders');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['models'] = Slider::orderBy('id', 'desc')->paginate(10);

        return view('admin.sliders.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.sliders.create');
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
            'name' => 'required|max:200',
            'description' => 'required',
            'image' => 'image'
        ]);

        $path = $request->file('image')->store('slider');

        $slider = new Slider($request->all());

        $image = $slider->uploadImage($request->file('image'), 'ugc/sliders');
        $slider->image = $image->lg;
        $slider->save();

        return redirect()->route('admin.sliders.index')->with(['status' => 'success', 'message' => 'Save Successfully']);
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
     * @param  Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit(Slider $slider)
    {
        return view('admin.sliders.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Slider $slider)
    {
        $request->validate([
            'name' => 'required|max:200',
            'description' => 'required',
            'image' => 'image'
        ]);

        if ($request->hasFile('image')) {
            $slider->deleteImage(@$slider->image->path);

            $newImage = $slider->uploadImage($request->file('image'), 'ugc/sliders');
            $slider->name = $request->name;
            $slider->description = $request->description;
            $slider->image = $newImage->lg;
            $slider->save();
        } else {
            $slider->update($request->only('name', 'description', 'url', 'type'));
        }

        return redirect()->route('admin.sliders.index')->with(['status' => 'success', 'message' => 'Update Successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Slider $slider
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Slider $slider)
    {
        if (Storage::exists($slider->image->path)) {
            Storage::delete($slider->image->path);
        }

        if ($slider->delete()) {
            return redirect()->route('admin.sliders.index')->with(['status' => 'success', 'message' => 'Delete Successfully']);
        }
        return redirect()->route('admin.sliders.index')->with(['status' => 'danger', 'message' => 'Delete Failed, Contact Developer']);
    }
}
