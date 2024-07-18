<?php

namespace App\Http\Controllers\Admin\Portofolio;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Portofolio\Portofolio;
use App\Models\Portofolio\Portofolio_image;
use App\Models\Portofolio\CategoryPortofolio;
use App\Models\Client;
use Illuminate\Support\Facades\Auth;

class PortofolioController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:portofolio post read');
        $this->middleware('permission:portofolio post create')->only('create', 'store');
        $this->middleware('permission:portofolio post update')->only('edit', 'update');
        $this->middleware('permission:portofolio post delete')->only('destroy');

        view()->share('menuActive', 'portofolio');
        view()->share('subMenuActive', 'portofolio-post');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['models'] = Portofolio::orderBy('id', 'desc')->paginate(10);
        $data['clients'] = Client::all();
        return view('admin.portofolio.posts.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['categories'] = CategoryPortofolio::all();
        $data['clients'] = Client::all();
        return view('admin.portofolio.posts.create', $data);
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
            'title' => 'required|max:300',
            'description' => 'required'
        ]);

        $portofolio = new Portofolio($request->except('image'));
        $portofolio->user_id = auth()->guard('web')->user()->id;

        if ($portofolio->save()) {
            if ($request->hasFile('image')) {
                foreach ($request->image as $key => $value) {

                    $image                  = new Portofolio_image();
                    $imagex = $image->uploadImage($value, 'ugc/portofolio');
                    $image->portfolio_id    = $portofolio->id;
                    $image->image           = $imagex->lg;
                    $image->save();

                    if ($key == 0) {
                        $portofolio->image = $imagex->lg;
                        $portofolio->save();
                    }
                }
            }
        }

        return redirect()
            ->route('admin.portofolio.posts.index')
            ->with(['status' => 'error', 'message' => 'Save Successfully']);
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
     * @param  Portofolio  $portofolio
     * @return \Illuminate\Http\Response
     */
    public function edit(Portofolio $portofolio)
    {
        $data['model'] = $portofolio;
        $data['categories'] = CategoryPortofolio::all();
        $data['clients'] = Client::all();

        return view('admin.portofolio.posts.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Portofolio  $portofolio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Portofolio $portofolio)
    {
        $request->validate([
            'title'         => 'required|max:200',
            'description'   => 'required'
        ]);

        //echo json_encode($request->all()); exit();

        // cek gambar yg sekrang
        $recentImage  = Portofolio_image::where('portfolio_id', $portofolio->id)->get();

        // gambar Update
        foreach ($recentImage as $key => $result) {
            // cek jika gambar diganti
            if ($request->file('image-' . $result->id)) {
                $newImage = $result->uploadImage($request->file('image-' . $result->id), 'ugc/portofolio');

                if ($newImage) {
                    $result->deleteImage();
                }
                $result->update(['portfolio_id' => $portofolio->id, 'image' => $newImage->lg]);
            }
            // gambar dihapus
            elseif (!$request->input('isimage-' . $result->id) and !$request->input('old-' . $result->id)) {
                $result->deleteImage();  // hapus gambar di storage
                $result->delete(); // hapus data
            }
        }

        // image baru
        if ($request->hasFile('image')) {
            foreach ($request->image as $key => $value) {
                if ($value) {
                    $image                 = new Portofolio_image();
                    $imagex = $image->uploadImage($value, 'ugc/portofolio');
                    $image->portfolio_id    = $portofolio->id;
                    $image->image           = $imagex->lg;
                    $image->save();
                }
            }
        }
        $request->user_id = auth()->guard('web')->user()->id;

        $portofolio->update($request->all());

        return redirect()->route('admin.portofolio.posts.index')->with(['status' => 'success', 'message' => 'Update Successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Portofolio $portofolio
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Portofolio $portofolio)
    {
        foreach ($portofolio->images as $key => $value) {
            $value->deleteImage();
            $value->delete(); // hapus data
        }

        if ($portofolio->delete()) {
            return redirect()->route('admin.portofolio.posts.index')->with(['status' => 'success', 'message' => 'Delete Successfully']);
        }

        return redirect()->route('admin.portofolio.posts.index')->with(['status' => 'danger', 'message' => 'Delete Failed, Contact Developer']);
    }
}
