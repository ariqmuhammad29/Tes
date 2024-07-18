<?php

namespace App\Http\Controllers\Admin\SocialMedia;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SocialMedia;

class SocialMediaController extends Controller
{

    public function __construct() {
        $this->middleware('permission:social read');
        $this->middleware('permission:social create')->only('create', 'store');
        $this->middleware('permission:social update')->only('edit', 'update');
        $this->middleware('permission:social delete')->only('destroy');

        view()->share('menuActive', 'footer');
        view()->share('subMenuActive', 'social-media');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $data['models'] = SocialMedia::orderBy('id', 'desc')->paginate(10);
        // return view('admin.social.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('admin.social.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'title' => 'required|max:250',
        //     'type'  => 'required',
        //     'url'   => 'required'
        // ]);
    
        // // Periksa apakah jenis sosial media yang dipilih sudah ada dalam database
        // $existingSocialMedia = SocialMedia::where('type', $request->type)->exists();
    
        // if ($existingSocialMedia) {
        //     return redirect()
        //         ->back()
        //         ->with(['status' => 'error', 'message' => 'Failed to add data. Social media type already exists.']);
        // }
    
        // // Jika tidak ada jenis yang sama, simpan data
        // $social = new SocialMedia($request->all());
        // $social->save();
    
        // return redirect()
        //     ->route('admin.social.index')
        //     ->with(['status' => 'success', 'message' => 'Save Successfully']);
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
     * @param  SocialMedia  $social
     * @return \Illuminate\Http\Response
     */
    public function edit(SocialMedia $social)
    {
        // $data['model'] = $social;
        // return view('admin.social.edit', $data);
        $data = SocialMedia::first();
        return view('admin.social.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  SocialMedia  $social
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SocialMedia $social)
    {
        // $request->validate([
        //     'title' => 'required|max:250',
        //     'type'  => 'required',
        //     'url'   => 'required'
        // ]);
    
        // // Periksa apakah type yang dipilih telah digunakan sebelumnya
        // $existingSocialMedia = SocialMedia::where('type', $request->type)
        //                                    ->where('id', '!=', $social->id)
        //                                    ->exists();
    
        // if ($existingSocialMedia) {
        //     return redirect()->back()->withInput()->withErrors(['type' => 'The selected type is already in use. Please choose another type.']);
        // }
    
        // $social->update($request->all());
        
        // return redirect()->route('admin.social.index')->with(['status' => 'success', 'message' => 'Update Successfully']);
        $request->validate([
            'instagram'           => 'required|max:250',
            'facebook'     => 'required',
        ]);

        $social = SocialMedia::first();
        if ($social) {
            $social->update($request->only('instagram', 'facebook'));
        } else {
            $social = new SocialMedia($request->only('instagram', 'facebook'));
            $social->save();
        }
        

        return redirect()->route('admin.social.edit')->with(['status' => 'success', 'message' => 'Update Successfully']);
    }

    

    /**
     * Remove the specified resource from storage.
     *
     * @param  SocialMedia $social
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(SocialMedia $social)
    {

        // if ($social->delete()) {
        //     return redirect()->route('admin.social.index')->with(['status' => 'success', 'message' => 'Delete Successfully']);
        // }

        // return redirect()->route('admin.social.index')->with(['status' => 'danger', 'message' => 'Delete Failed, Contact Developer']);
    }
}
