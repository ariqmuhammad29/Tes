<?php

namespace App\Http\Controllers\Admin\Testimoni;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Testimoni;
use Illuminate\Support\Facades\Storage;

class TestimoniController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:testimoni read');
        $this->middleware('permission:testimoni create')->only('create', 'store');
        $this->middleware('permission:testimoni update')->only('edit', 'update');
        $this->middleware('permission:testimoni delete')->only('destroy');

        view()->share('menuActive', 'landing-page');
        view()->share('subMenuActive', 'testimoni');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['models'] = Testimoni::orderBy('id', 'desc')->paginate(10);
        return view('admin.testimoni.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.testimoni.create');
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
            'name'    => 'required',
            'comment' => 'required|max:500',
            'position' => 'required',   
            'rate' => 'required',
            'image'    => 'required|image'
        ]);

        $testimoni = new Testimoni($request->all());

        $image = $testimoni->uploadImage($request->file('image'), 'ugc/testimoni');
        $testimoni->image = $image->lg;

        $testimoni->save();

        return redirect()
            ->route('admin.testimoni.index')
            ->with(['status' => 'success', 'message' => 'Save Successfully']);
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
     * @param  Testimoni  $testimoni
     * @return \Illuminate\Http\Response
     */
    public function edit(Testimoni $testimoni)
    {
        $data['model'] = $testimoni;
        return view('admin.testimoni.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Testimoni  $testimoni
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Testimoni $testimoni)
    {

        $request->validate([
            'name'    => 'required',
            'comment' => 'required|max:500',
            'position' => 'required',   
            'rate' => 'required',
            'image'    => 'image'
        ]);

        if ($request->hasFile('image')) {
            $newImage = $testimoni->uploadImage($request->file('image'), 'ugc/testimoni');

            $payload = $request->all();

            if ($newImage) {
                $payload['image'] = $newImage->lg;

                $testimoni->deleteImage();
            }

            $testimoni->update($payload);
        } else {
            $testimoni->update($request->all());
        }

        return redirect()->route('admin.testimoni.index')->with(['status' => 'success', 'message' => 'Update Successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Testimoni $testimoni
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Testimoni $testimoni)
    {
        if (Storage::exists($testimoni->image->path)) {
            Storage::delete($testimoni->image->path);
        }

        if ($testimoni->delete()) {
            return redirect()->route('admin.testimoni.index')->with(['status' => 'success', 'message' => 'Delete Successfully']);
        }

        return redirect()->route('admin.testimoni.index')->with(['status' => 'danger', 'message' => 'Delete Failed, Contact Developer']);
    }
}
