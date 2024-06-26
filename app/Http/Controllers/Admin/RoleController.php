<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('role_or_permission:Role Read|Role Create|Role Edit|Role Delete', ['only' => ['index','show']]);
        $this->middleware('role_or_permission:Role Create', ['only' => ['create','store']]);
        $this->middleware('role_or_permission:Role Edit', ['only' => ['edit','update']]);
        $this->middleware('role_or_permission:Role Delete', ['only' => ['destroy']]);
    }

    protected function getDefaultGuardName(): string { return 'web'; }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::latest()->get();
        return view('admin.roles.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::get();
        return view('admin.roles.create',compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    { 
        $request->validate(['name'=>'required']);

        $role = Role::create(['guard_name' => 'web','name'=>$request->name]);

        $role->syncPermissions($request->permissions);
        
        toastr()->success('Role Created');
        return to_route('admin.roles.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // toastr()->warning('Please try Later');
        return redirect()->back();
        // $user = User::findOrFail($id);
        // return view('admin.users.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $role = Role::find(decrypt($id));
        $permissions = Permission::get();
        $role->permissions;
        return view('admin.roles.edit',compact('permissions','role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $role->update(['guard_name' => 'web']);
        $role->syncPermissions($request->permissions);
        
        Session::flash('success', 'Role Updated');
        return to_route('admin.roles.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $result = $role->delete();
        if($result){
            toastr()->success('Role Deleted');
        }else{
            toastr()->error('An error occured!');
        }
        return to_route('admin.roles.index');
    }
}
