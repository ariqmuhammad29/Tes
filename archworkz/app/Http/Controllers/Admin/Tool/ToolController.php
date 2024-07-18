<?php

namespace App\Http\Controllers\Admin\Tool;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tool;
use Illuminate\Support\Facades\Storage;


class ToolController extends Controller
{

    /**
     * SliderController constructor.
     */
    public function __construct()
    {
        // $this->slider = new Slider(); # <-- iki gae opo, kan hanya digunakan di fungsi `store` tok?

        $this->middleware('permission:tools read');
        $this->middleware('permission:tools create')->only('create', 'store');
        $this->middleware('permission:tools update')->only('edit', 'update');
        $this->middleware('permission:tools delete')->only('destroy');

        view()->share('menuActive', 'landing-page');
        view()->share('subMenuActive', 'tools');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['models'] = Tool::orderBy('id', 'desc')->paginate(10);

        return view('admin.tools.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tools.create');
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

        $path = $request->file('image')->store('tool');

        $tool = new Tool($request->all());

        $image = $tool->uploadImage($request->file('image'), 'ugc/tools');
        $tool->image = $image->lg;
        $tool->save();

        return redirect()->route('admin.tools.index')->with(['status' => 'success', 'message' => 'Save Successfully']);
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
     * @param  Tool $tool
     * @return \Illuminate\Http\Response
     */
    public function edit(Tool $tool)
    {
        return view('admin.tools.edit', compact('tool'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Tool  $tool
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tool $tool)
    {
        $request->validate([
            'name' => 'required|max:200',
            'description' => 'required',
            'image' => 'image'
        ]);

        if ($request->hasFile('image')) {
            $tool->deleteImage(@$tool->image->path);

            $newImage = $tool->uploadImage($request->file('image'), 'ugc/tools');
            $tool->name = $request->name;
            $tool->description = $request->description;
            $tool->image = $newImage->lg;
            $tool->save();
        } else {
            $tool->update($request->only('name', 'description', 'url', 'type'));
        }

        return redirect()->route('admin.tools.index')->with(['status' => 'success', 'message' => 'Update Successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Tool $tool
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Tool $tool)
    {
        if (Storage::exists($tool->image->path)) {
            Storage::delete($tool->image->path);
        }

        if ($tool->delete()) {
            return redirect()->route('admin.tools.index')->with(['status' => 'success', 'message' => 'Delete Successfully']);
        }
        return redirect()->route('admin.tools.index')->with(['status' => 'danger', 'message' => 'Delete Failed, Contact Developer']);
    }
}
