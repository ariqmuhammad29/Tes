<?php

namespace App\Http\Controllers\Admin\Tamu;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Jam;
use App\Models\Tamu;
use Illuminate\Validation\Rule;
use App\User;

class TamuController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:tamu read');
        $this->middleware('permission:tamu create')->only('create', 'store');
        $this->middleware('permission:tamu update')->only('edit', 'update');
        $this->middleware('permission:tamu delete')->only('destroy');
        $this->middleware('permission:tamu coming')->only('coming');
        $this->middleware('permission:tamu confirm')->only('confirm');

        view()->share('menuActive', 'tamu');
        view()->share('subMenuActive', 'undangan');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Tamu $tamu)
    {
        if ($request->has('name') != "") {
            $tamu = $tamu->where('title', 'like', '%' . $request->get('name') . '%');
        }

        if ($request->get('admin') != "") {
            $tamu = $tamu->where('user_id', $request->get('admin'));
        }

        if ($request->get('jam') != "") {
            $tamu = $tamu->where('jam', $request->get('jam'));
        }

        if ($request->get('shortby') != "") {
            if ($request->get('shortby') == "Jam Undangan") {
                $tamu = $tamu->orderBy('jam', 'asc');
            }
            if ($request->get('shortby') == "Admin") {
                $tamu = $tamu->orderBy('user_id', 'asc');
            }
            if ($request->get('shortby') == "Nama Tamu") {
                $tamu = $tamu->orderBy('title', 'asc');
            }
        }

        $roleID = [1, 2, 3, 4];
        $data['admins'] = User::whereHas('roles', function ($query) use ($roleID) {
            $query->whereIn('roles.id', $roleID);
        })->get();

        $data['jams'] = Jam::get();

        if (auth()->user()->hasRole('admin') || auth()->user()->hasRole('superadmin')) {
            $data['models'] = $tamu->paginate(10)->withQueryString();
        } else {
            $data['models'] = $tamu->where('user_id', auth()->user()->id)->paginate(10)->withQueryString();
        }
        return view('admin.tamu.index', $data);
    }

    public function confirm()
    {
        $data['models'] = Tamu::where('konfirmasi', '1')->orderBy('id', 'desc')->paginate(10);
        return view('admin.tamu.confirm', $data);
    }
    public function coming()
    {
        $data['models'] = Tamu::where('datang', '1')->orderBy('id', 'desc')->paginate(10);
        return view('admin.tamu.coming', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['jam'] = Jam::all();
        return view('admin.tamu.create', $data);
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
            'title' => 'required|max:500',
            // 'phone' => ["required", "regex:/^(\+?62)\d{4,14}$/", "unique:tamus"],
            'jam' => 'required'
        ]);

        $request->request->add(['user_id' => auth()->guard('web')->user()->id]);
        $Tamu = new Tamu($request->all());

        $Tamu->save();

        return redirect()
            ->route('admin.tamu.index')
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
     * @param  Tamu  $Tamu
     * @return \Illuminate\Http\Response
     */
    public function edit(Tamu $Tamu)
    {
        $data['jam'] = Jam::all();
        $data['model'] = $Tamu;
        return view('admin.tamu.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Tamu  $Tamu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tamu $Tamu)
    {
        $request->validate([
            'title' => 'required|max:500',
            // 'phone' => ["required", "regex:/^(\+?62)\d{4,14}$/", Rule::unique('tamus')->ignore($Tamu->id)],
            'jam' => 'required'
        ]);

        $Tamu->update($request->all());

        return redirect()->route('admin.tamu.index')->with(['status' => 'success', 'message' => 'Update Successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Tamu $Tamu
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Tamu $Tamu)
    {
        if ($Tamu->delete()) {
            return redirect()->route('admin.tamu.index')->with(['status' => 'success', 'message' => 'Delete Successfully']);
        }

        return redirect()->route('admin.tamu.index')->with(['status' => 'danger', 'message' => 'Delete Failed, Contact Developer']);
    }
}
