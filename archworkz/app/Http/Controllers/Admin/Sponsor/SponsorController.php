<?php

namespace App\Http\Controllers\Admin\Sponsor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Sponsor;
use Illuminate\Support\Facades\Storage;


class SponsorController extends Controller
{

    /**
     * SliderController constructor.
     */
    public function __construct()
    {
        // $this->slider = new Slider(); # <-- iki gae opo, kan hanya digunakan di fungsi `store` tok?

        $this->middleware('permission:sponsors read');
        $this->middleware('permission:sponsors create')->only('create', 'store');
        $this->middleware('permission:sponsors update')->only('edit', 'update');
        $this->middleware('permission:sponsors delete')->only('destroy');

        view()->share('menuActive', 'landing-page');
        view()->share('subMenuActive', 'sponsors');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['models'] = Sponsor::orderBy('id', 'desc')->paginate(10);

        return view('admin.sponsors.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.sponsors.create');
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

        $path = $request->file('image')->store('sponsor');

        $sponsor = new Sponsor($request->all());

        $image = $sponsor->uploadImage($request->file('image'), 'ugc/sponsors');
        $sponsor->image = $image->lg;
        $sponsor->save();

        return redirect()->route('admin.sponsors.index')->with(['status' => 'success', 'message' => 'Save Successfully']);
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
     * @param  Sponsor $sponsor
     * @return \Illuminate\Http\Response
     */
    public function edit(Sponsor $sponsor)
    {
        return view('admin.sponsors.edit', compact('sponsor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Sponsor  $sponsor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sponsor $sponsor)
    {
        $request->validate([
            'name' => 'required|max:200',
            'description' => 'required',
            'image' => 'image'
        ]);

        if ($request->hasFile('image')) {
            $sponsor->deleteImage(@$sponsor->image->path);

            $newImage = $sponsor->uploadImage($request->file('image'), 'ugc/sponsors');
            $sponsor->name = $request->name;
            $sponsor->description = $request->description;
            $sponsor->image = $newImage->lg;
            $sponsor->save();
        } else {
            $sponsor->update($request->only('name', 'description', 'url', 'type'));
        }

        return redirect()->route('admin.sponsors.index')->with(['status' => 'success', 'message' => 'Update Successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Sponsor $sponsor
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Sponsor $sponsor)
    {
        if (Storage::exists($sponsor->image->path)) {
            Storage::delete($sponsor->image->path);
        }

        if ($sponsor->delete()) {
            return redirect()->route('admin.sponsors.index')->with(['status' => 'success', 'message' => 'Delete Successfully']);
        }
        return redirect()->route('admin.sponsors.index')->with(['status' => 'danger', 'message' => 'Delete Failed, Contact Developer']);
    }
}
