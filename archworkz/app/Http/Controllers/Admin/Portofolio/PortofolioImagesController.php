<?php

namespace App\Http\Controllers\Admin\Portofolio;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Portofolio\Portofolio_image;
use Illuminate\Support\Facades\Storage;

class PortofolioImagesController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:portofolio images read');
        $this->middleware('permission:portofolio images create')->only('create', 'store');
        $this->middleware('permission:portofolio images update')->only('edit', 'update');
        $this->middleware('permission:portofolio images delete')->only('destroy');

        view()->share('menuActive', 'landing-page');
        view()->share('subMenuActive', 'Portofolio');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['models'] = Portofolio_image::orderBy('id', 'desc')->paginate(10);
        return view('admin.portofolio.images.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.portofolio.images.create');
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
            'portfolio_id'  => 'required',
            'image'         => 'required|image'
        ]);

        $path = $request->file('image')->store('portofolio');

        $portofolioimages = new Portofolio_image($request->only('portfolio_id') + ['image' => $path]);
        $portofolioimages->save();

        return redirect()
            ->route('admin.portofolio.images.index')
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
     * @param  PortofolioImages  $portofolioimages
     * @return \Illuminate\Http\Response
     */
    public function edit(PortofolioImages $portofolioimages)
    {
        return view('admin.portofolio.images.edit', ['model' => $portofolioimages]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  PortofolioImages  $portofolioimages
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PortofolioImages $portofolioimages)
    {
        $request->validate([
            'portfolio_id'  => 'required',
            'image'         => 'required|image'
        ]);

        if ($request->hasFile('image')) {

            if (Storage::exists($portofolioimages->image)) {
                Storage::delete($portofolioimages->image);
            }

            $path = $request->file('image')->store('portofolio');
            $update = $portofolioimages->update($request->only('portfolio_id') + ['image' => $path]);
        } else {
            $update = $portofolioimages->update($request->only('portfolio_id'));
        }

        return redirect()->route('admin.portofolio.images.edit', $portofolioimages->id)->with(['status' => 'danger', 'message' => 'Update Failed, Contact Developer']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  PortofolioImages $portofolioimages
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(PortofolioImages $portofolioimages)
    {
        if ($portofolioimages->delete()) {
            return redirect()->route('admin.portofolio.images.index')->with(['status' => 'success', 'message' => 'Delete Successfully']);
        }
        return redirect()->route('admin.portofolio.images.index')->with(['status' => 'danger', 'message' => 'Delete Failed, Contact Developer']);
    }
}
