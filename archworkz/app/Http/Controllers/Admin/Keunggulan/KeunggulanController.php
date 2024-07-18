<?php

namespace App\Http\Controllers\Admin\Keunggulan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Support\Facades\Storage; 

class KeunggulanController extends Controller
{

    public function __construct() {
        $this->middleware('permission:services read');
        $this->middleware('permission:services create')->only('create', 'store');
        $this->middleware('permission:services update')->only('edit', 'update');
        $this->middleware('permission:services delete')->only('destroy');

        view()->share('menuActive', 'landing-page');
        view()->share('subMenuActive', 'keunggulan');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['models'] = Service::orderBy('id', 'desc')->Keunggulan()->paginate(10);
        return view('admin.keunggulan.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.keunggulan.create');
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
            'title'           => 'required|max:250',
            'type'            => 'required',
            'description_short'=> 'required',
            'description'     => 'required',
            'image'           => 'required|image'
        ]);

        $keunggulan = new Service($request->all());

        $image = $keunggulan->uploadImage($request->file('image'), 'ugc/service');
        $keunggulan->image = $image->lg;

        $keunggulan->save();

        return redirect()
            ->route('admin.keunggulan.index')
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
     * @param  Service  $keunggulan
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $keunggulan)
    {
        $data['model'] = $keunggulan;
        return view('admin.keunggulan.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Service  $keunggulan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $keunggulan)
    {
        $request->validate([
            'title'           => 'required|max:250',
            'description_short'=> 'required',
            'description'     => 'required',
            'image'           => 'image'
        ]);

        if ($request->hasFile('image')) {
            $newImage = $keunggulan->uploadImage($request->file('image'), 'ugc/service');

            $payload = $request->all();

            if ($newImage) {
                $payload['image'] = $newImage->lg;

                $keunggulan->deleteImage();
            }

            $keunggulan->update($payload);
        } else {
            $keunggulan->update($request->all());
        }

        return redirect()->route('admin.keunggulan.index')->with(['status' => 'success', 'message' => 'Update Successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Service $keunggulan
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Service $keunggulan)
    {
        if (Storage::exists($keunggulan->image)) {
            Storage::delete($keunggulan->image);
        }

        if ($keunggulan->delete()) {
            return redirect()->route('admin.keunggulan.index')->with(['status' => 'success', 'message' => 'Delete Successfully']);
        }

        return redirect()->route('admin.keunggulan.index')->with(['status' => 'danger', 'message' => 'Delete Failed, Contact Developer']);
    }
}
