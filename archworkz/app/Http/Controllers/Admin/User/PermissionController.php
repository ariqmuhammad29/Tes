<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    
    public function __construct() {
        $this->middleware('role:superadmin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Role $role)
    {
        $role->load('permissions');
        $allPermissions = Permission::get();

        return view('admin.users.roles.permissions.index', compact(
            'role',
            'allPermissions'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Role $role)
    {
        $permissionNames = collect($request->except('_token'))
            ->keys()
            ->map(function ($key) {
                return str_replace('_', ' ', $key);
            });

        $permissions = Permission::whereIn('name', $permissionNames)->get();

        $role->syncPermissions($permissions);

        return redirect()->back()->with([
            'status' => 'success',
            'message' => 'Permissions are updated.'
        ]);
    }
}
