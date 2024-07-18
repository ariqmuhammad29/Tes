<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    
    public function __construct() {
        $this->middleware('permission:roles read');
        $this->middleware('permission:roles create')->only('create', 'store');
        $this->middleware('permission:roles update')->only('edit', 'update');
        $this->middleware('permission:roles delete')->only('destroy');
        
        view()->share('menuActive', 'users');
        view()->share('subMenuActive', 'roleAndPermissions');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $roles = Role::withCount('permissions', 'users')
            ->paginate($request->take ?? 12);

        return view('admin.users.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.roles.create');
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
            'name' => [
                'required',
                Rule::unique('roles')
            ],
        ]);

        Role::create($request->all());

        return redirect()->route('admin.roles.index')->with([
            'status' => 'success',
            'message' => 'New role has been created.'
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
     * @param  Role $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        return view('admin.users.roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Role $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => [
                'required',
                Rule::unique('roles')->ignore($role)
            ],
        ]);

        $role->update($request->all());

        return redirect()->back()->with([
            'status' => 'success',
            'message' => 'Role has been updated.'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Role $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        if ($role->name === 'superadmin') {
            return redirect()->back()->with([
                'status' => 'warning',
                'message' => 'Role superadmin can\'t be delete'
            ]);
        }

        $role->delete();

        return redirect()->back()->with([
            'status' => 'success',
            'message' => 'Role has been deleted.'
        ]);
    }
}
