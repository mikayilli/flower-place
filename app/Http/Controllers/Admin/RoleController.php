<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:role-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:role-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $roles = Role::with('permissions')->paginate(20);
        return view("admin.roles.index", compact('roles'));
    }

    public function create()
    {
        $pageTitle = "Create";
        $permission = Permission::get();
        return view("admin.roles.add-edit", compact('pageTitle', 'permission'));
    }

    public function edit(Role $role)
    {
        $pageTitle = "Update";
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $role->id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();
        return view("admin.roles.add-edit", compact('role', 'pageTitle', 'permission', 'rolePermissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            "name" => "required_without:id|max:30|unique:roles,name," . $request->id,
            'permission' => 'required',
        ]);

        $role = Role::updateOrcreate([
            "id" => $request->id,
        ], [
            "name" => $request->name,
            "guard_name" => "web"
        ]);

        $role->syncPermissions($request->input('permission'));

        return redirect()->route("roles.index")->with("message", "Successfully done!");
    }

    public function destroy(Role $role)
    {
        $role->deleteOrFail();
        return redirect()->route("roles.index")->with("message", "Successfully deleted!");
    }
}
