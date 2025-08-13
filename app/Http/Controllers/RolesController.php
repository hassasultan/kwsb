<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;


class RolesController extends Controller
{
    //
    public function index()
    {
        $roles = Role::orderBy('name', 'asc')->get();
        return view('pages.roles.index', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::orderBy('name', 'asc')->get();

        return view('pages.roles.create',compact('permissions'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);

        $role = Role::create(['name' => $request->get('name')]);
        $role->syncPermissions($request->get('permission'));
        return redirect()->route('roles.index')->with('success', 'Role created successfully.');
    }

    public function edit($id)
    {
        $role = Role::find($id);
        $rolePermissions = $role->permissions->pluck('name')->toArray();
        $permissions = Permission::orderBy('name', 'asc')->get();
        return view('pages.roles.edit', compact('role','rolePermissions', 'permissions'));
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $role = Role::find($id);
        $role->update($request->only('name'));
        $role->syncPermissions($request->get('permission'));

        return redirect()->route('roles.index')->with('success', 'Role updated successfully.');
    }

    public function destroy($id)
    {
        Role::find($id)->delete();

        return redirect()->route('roles.index')->with('success', 'Role deleted successfully.');
    }
}
