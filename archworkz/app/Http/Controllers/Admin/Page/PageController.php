<?php

namespace App\Http\Controllers\Admin\Page;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Support\Facades\Storage;

class PageController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:pages read');
        $this->middleware('permission:pages create')->only('create', 'store');
        $this->middleware('permission:pages update')->only('edit', 'update');
        $this->middleware('permission:pages delete')->only('destroy');

        view()->share('menuActive', 'landing-page');
        view()->share('subMenuActive', 'pages');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['models'] = Page::orderBy('id', 'desc')->paginate(10);
        return view('admin.pages.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.create');
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
            'title' => 'required|max:200',
            'description' => 'required',
            'image' => 'required|image'
        ]);

        $page = new Page($request->all());

        $image = $page->uploadImage($request->file('image'), 'ugc/blog');
        $page->image = $image->lg;

        $page->save();

        return redirect()
            ->route('admin.pages.index')
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
     * @param  Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        $data['model'] = $page;
        return view('admin.pages.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Page $page)
    {
        $request->validate([
            'title' => 'required|max:200',
            'description' => 'required',
            'image' => 'image'
        ]);

        if ($request->hasFile('image')) {
            $newImage = $page->uploadImage($request->file('image'), 'ugc/blog');

            $payload = $request->all();

            if ($newImage) {
                $payload['image'] = $newImage->lg;

                $page->deleteImage();
            }

            $page->update($payload);
        } else {
            $page->update($request->all());
        }

        return redirect()->route('admin.pages.index')->with(['status' => 'success', 'message' => 'Update Successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Page $page
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Page $page)
    {
        $image = new Page();

        if (Storage::exists($page->image->path)) {
            $image->deleteImage($page->image->path);
        }

        if ($page->delete()) {
            return redirect()->route('admin.pages.index')->with(['status' => 'success', 'message' => 'Delete Successfully']);
        }

        return redirect()->route('admin.pages.index')->with(['status' => 'danger', 'message' => 'Delete Failed, Contact Developer']);
    }
}
