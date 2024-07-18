<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    
    public function __construct() {
        $this->middleware('permission:users read');
        $this->middleware('permission:users create')->only('create', 'store');
        $this->middleware('permission:users update')->only('edit', 'update');
        $this->middleware('permission:users delete')->only('destroy');

        view()->share('menuActive', 'users');
        view()->share('subMenuActive', 'users');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::with('roles')
            ->select('users.*')
            ->leftJoin('model_has_roles', function ($join) {
                $join->on('model_has_roles.model_id', '=', 'users.id')
                    ->where('model_has_roles.model_type', '=', User::class);
            })
            ->leftJoin('roles', 'roles.id', '=', 'model_has_roles.role_id')
            ->orderBy('roles.id')
            ->orderBy('users.name')
            ->paginate($request->take ?: 10);
        
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $admin = auth()->user();
        $roles = Role::get();

        // return $user;

        return view('admin.users.create', compact('admin', 'roles'));
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
            'name' => ['required'],
            'username' => [
                'required',
                Rule::unique('users')
            ],
            'email' => [
                'required',
                Rule::unique('users')
            ],
            'password' => [
                'required',
                'confirmed'
            ],
            'role' => [
                'required',
                Rule::notIn(['superadmin'])
            ],
            'image' => ['image']
        ]);

        $user = new User();
        $user->password = Hash::make($request->password);

        if ($request->file('image')) {
            $newImage = $user->uploadImage($request->file('image'), 'ugc/images');
        }

        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        
        if (@$newImage) {
            $user->image = @$newImage->lg;
        }
        
        $user->save();

        $user->syncRoles(Role::whereName($request->role)->firstOrFail());

        return redirect()->route('admin.users.edit', [$user->id])->with([
            'status' => 'success',
            'message' => 'User has been created'
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
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $user->load('roles');
        $roles = Role::get();


        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => ['required'],
            'username' => [
                'required',
                Rule::unique('users')->ignore($user)
            ],
            'email' => [
                'required',
                Rule::unique('users')->ignore($user)
            ],
            'password' => [
                Rule::requiredIf($request->old_password),
                'confirmed'
            ],
            'password_confirmation' => [Rule::requiredIf($request->password)],
            'role' => [
                Rule::notIn(['superadmin'])
            ],
            'image' => ['image']
        ]);

        if ($request->old_password) {
            if (!Hash::check($request->old_password, $user->password)) {
                return redirect()
                    ->back()
                    ->withErrors([
                        'old_password' => 'Old password is incorrect'
                    ])
                    ->withInput();
            }

            $user->password = Hash::make($request->password);
        }

        $admin = auth()->user();

        if ($request->role && $admin->hasRole('superadmin') && !$user->hasRole('superadmin')) {
            # ganti role nya
            $user->syncRoles(Role::whereName($request->role)->firstOrFail());
        }

        if ($request->file('image')) {
            $newImage = $user->uploadImage($request->file('image'), 'ugc/images');
        }

        # hapus image kalau sebelumnya udah ada
        if (@$newImage && $user->image) {
            $user->deleteImage($user->image->path);
        }

        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        
        if (@$newImage) {
            $user->image = @$newImage->lg;
        }
        
        $user->save();

        return redirect()->back()->with([
            'status' => 'success',
            'message' => 'User has been updated'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $role = $user->roles()->first();
        $admin = auth()->user();

        if ($role && $role->name === 'superadmin') {
            return redirect()->back()->with([
                'status' => 'warning',
                'message' => 'Superadmin can\'t be delete.'
            ]);
        }

        if ($admin->id === $user->id) {
            return redirect()->back()->with([
                'status' => 'warning',
                'message' => 'You can\'t delete your self.'
            ]);
        }

        $user->delete();

        return redirect()->back()->with([
            'status' => 'info',
            'message' => 'User deleted.'
        ]);
    }
}
