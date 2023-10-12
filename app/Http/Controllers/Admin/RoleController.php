<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Inertia\Inertia;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::whereNotIn('name', ['admin'])->get();
        return Inertia::render('admin/roles/index', ['roles' => $roles]);
    }

    public function create()
    {
        return Inertia::render('admin/roles/create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate(['name' => ['required', 'min:3']]);
        Role::create($validated);

        return redirect()->route('admin.roles.index')->with('message', 'Role Created successfully.');
    }

    public function edit(Role $role)
    {
        $permissions = Permission::all();
        $rolePermission = $role->permissions;
        return Inertia::render('admin/roles/edit', ['role' => $role, 'permissions' => $permissions, 'rolePermission' => $rolePermission]);
    }

    public function update(Request $request, Role $role)
    {
        $validated = $request->validate(['name' => ['required', 'min:3']]);
        $role->update($validated);

        return redirect()->route('admin.roles.index')->with('message', 'Role Updated successfully.');
    }

    public function destroy(Role $role)
    {
        $role->delete();

        return redirect()->route('admin.roles.index')->with('message', 'Role deleted.');
    }

    public function givePermission(Request $request, Role $role)
    {
        if ($role->hasPermissionTo($request->permission)) {
            return back()->with('message', 'Permission exists.');
        }

        $role->givePermissionTo($request->permission);
        return back()->with('message', 'Permission added.');
    }

    public function revokePermission(Role $role, Permission $permission)
    {
        if ($role->hasPermissionTo($permission)) {
            $role->revokePermissionTo($permission);
            return back()->with('message', 'Permission revoked.');
        }

        return back()->with('message', 'Permission not exists.');
    }
}
