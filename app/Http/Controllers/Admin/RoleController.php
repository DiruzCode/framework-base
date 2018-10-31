<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RoleController extends Controller
{

      public function index(Request $request) {

          $roles = Role::query();

          if ($request->has('search')) {
              $search = $request->get('search');
              $roles->where(function ($q) use ($search) {
                  $q->orWhere('name', 'like', "%$search%");
              });
          }

          return view('admin.roles.index', [
              'items' => $roles->paginate(config('ui.admin.page_size')),
              'page' => $request->query('page')
          ]);
      }

      public function create(Request $request) {

        $page = $request->query('page');
        $permissions = Permission::orderBy('name', 'asc')->pluck('name', 'id');

        return view('admin.roles.create', [
            'cancel_link' => route('admin::roles.index', ['page' => $page]),
            'permissions'       => $permissions,
            'permission_id'     => (!is_null(old('permission_id')))? old('permission_id'):[],
            'page' => $page,
            'permissions' => $permissions
        ]);

      }

      public function store(Request $request)
      {

          \DB::beginTransaction();

            $role = Role::create([
              'display_name' => $request->get('display_name'),
              'name' => $request->get('name'),
              'description' => $request->get('description'),
            ]);

            $permissions = Permission::whereIn('id',$request->get('permission_id'))->get();

            $role->syncPermissions($permissions);

          \DB::commit();

          return redirect()->route('admin::roles.index')->with([
              'message' => "Se ha Actualizado el role ". $role->display_name,
              'level' => 'success'
          ]);
      }

      public function edit(Request $request, $id) {
          $role = Role::findOrFail($id);
          $permissions = Permission::orderBy('name', 'asc')->pluck('name', 'id');

          return view('admin.roles.edit', [
              'model'         => $role,
              'permissions'   => $permissions,
              'permission_id' => $request->old('permission_id', $role->permissions->pluck('id')->toArray()),
              'page'          => $request->query('page'),
              'cancel_link'   => '/admin/roles',
          ]);
      }

      public function update(Request $request, $id)
      {

          \DB::beginTransaction();

            $role = Role::findOrFail($id);

            $role->update([
              'display_name' => $request->get('display_name'),
              'name' => $request->get('name'),
              'description' => $request->get('description'),
            ]);

            $permissions = Permission::whereIn('id',$request->get('permission_id'))->get();

            $role->syncPermissions($permissions);

          \DB::commit();

          return redirect()->route('admin::roles.index')->with([
              'message' => "Se ha Actualizado el role ". $role->name,
              'level' => 'success'
          ]);
      }

      public function slug($name)
      {

          return response()->json(['slug' => str_slug($name)]);
      }
}
