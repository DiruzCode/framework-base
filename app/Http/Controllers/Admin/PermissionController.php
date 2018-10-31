<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class PermissionController extends Controller
{

    public function index(Request $request)
    {
        $permissions = Permission::query();

        if ($request->has('search')) {
            $search = $request->get('search');
            $permissions->where(function ($q) use ($search) {
                $q->orWhere('name', 'like', "%$search%");
            });
        }

        return view('admin.permissions.index', [
            'items' => $permissions->paginate(config('ui.admin.page_size')),
            'page' => $request->query('page')
        ]);
    }

    public function create(Request $request) {

      $page = $request->query('page');
      $roles = Role::orderBy('name', 'asc')->pluck('name', 'id');
      return view('admin.permissions.create', [
          'roles'         => $roles,
          'role_id'       => $request->old('role_id'),
          'page'          => $request->query('page'),
          'cancel_link'   => route('admin::roles.index', ['page' => $page])
      ]);

    }

    public function store(Request $request) {

      \DB::beginTransaction();

        $permission = Permission::create([
          'display_name' => $request->get('display_name'),
          'name' => $request->get('name'),
          'description' => $request->get('description'),
        ]);

        $roles = Role::whereIn('id',$request->get('role_id'))->get();

        $permission->syncRoles($roles);

      \DB::commit();

      return redirect()->route('admin::permissions.index')->with([
          'message' => "Se creado el permiso ". $permission->display_name,
          'level' => 'success'
      ]);

    }

    public function edit(Request $request, $id)
    {
        $page = $request->query('page');

        $permission = Permission::findOrFail($id);
        $roles = Role::orderBy('name', 'asc')->pluck('name', 'id');
        return view('admin.permissions.edit', [
            'model'         => $permission,
            'roles'         => $roles,
            'role_id'       => $request->old('role_id', $permission->roles->pluck('id')->toArray()),
            'page'          => $request->query('page'),
            'cancel_link'   => route('admin::roles.index', ['page' => $page])
        ]);
    }

    public function update(Request $request, $id) {


        \DB::beginTransaction();

          $permission = Permission::findOrFail($id);

          $permission->update([
            'display_name' => $request->get('display_name'),
            'name' => $request->get('name'),
            'description' => $request->get('description'),
          ]);

          $roles = Role::whereIn('id',$request->get('role_id'))->get();

          $permission->syncRoles($roles);

        \DB::commit();

        return redirect()->route('admin::permissions.index')->with([
            'message' => "Se ha Actualizado el permiso ". $permission->name,
            'level' => 'success'
        ]);

    }
}
