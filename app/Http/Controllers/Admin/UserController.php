<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Auth;
use DB;
use Log;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\UserRequest;


class UserController extends Controller
{

      public function index(Request $request) {
        $users = User::query();

        if ($request->has('search')) {
            $search = $request->get('search');
            $users->where(function ($q) use ($search) {
                $q->orWhere('firstname', 'like', "%$search%")
                ->orWhere('firstname', 'like', "%$search%")
                ->orWhere('lastname', 'like', "%$search%")
                ->orWhere('email', 'like', "%$search%");
            });
        }

        return view('admin.users.index', [
            'items' => $users->paginate(config('ui.admin.page_size')),
            'page' => $request->query('page')
        ]);
      }

      public function create(Request $request) {

         $roles = Role::orderBy('name', 'asc')->pluck('name', 'id');
         $page = $request->query('page');

         return view('admin.users.create', [
             'status'            => $request->old('status', 'active'),
             'hidden'            => $request->old('hidden', false),
             'cancel_link'  => route('admin::users.index', ['page' => $page]),
             'roles'        => $roles,
             'role_id'      => $request->old('role_id'),
             'page'         => $page
         ]);
      }

      public function store(Request $request) {

        \DB::beginTransaction();
           $user = User::create([
             'email'             => $request->get('email'),
             'password'          => $request->get('password'),
             'status' => $request->has('status') ? 'active' : 'inactive',
             'hidden' => $request->has('hidden')

           ]);

           $roles = Role::whereIn('id',$request->get('role_id'))->get();
           $user->syncRoles($roles);
         \DB::commit();


         return redirect()->route('admin::users.index')->with([
             'message' => "Se creado el usuario ". $user->email,
             'level' => 'success'
         ]);
      }

      public function edit(Request $request, $id) {

        $user = User::findOrFail($id);
        $roles = Role::orderBy('name', 'asc')->pluck('name', 'id');
        $page = $request->query('page');

        return view('admin.users.edit', [
            'status' => $request->old('status', $user->status),
            'hidden' => $request->old('hidden', $user->hidden),
            'model'         => $user,
            'cancel_link'  => route('admin::users.index', ['page' => $page]),
            'roles'        => $roles,
            'role_id'      => $request->old('role_id', $user->roles->pluck('id')->toArray()),
            'page'         => $page
        ]);

      }

      public function update(UserRequest $request, $id) {
         $user = User::findOrFail($id);

         \DB::beginTransaction();
            $user->update([
              'email'             => $request->get('email'),
              'password'          => $request->get('password'),
              'status' => $request->has('status') ? 'active' : 'inactive',
              'hidden' => $request->has('hidden')
            ]);


            $roles = Role::whereIn('id',$request->get('role_id'))->get();
            $user->syncRoles($roles);
          \DB::commit();
          return redirect()->route('admin::users.index')->with([
              'message' => "Se actualizo el usuario ". $user->email,
              'level' => 'success'
          ]);
      }


      public function destroy($id){
          $user = User::find($id);
          $name = $user->completeName();
          $user->delete();
          return redirect()->route('admin::users.index')->with([
              'message' => "Se ha eliminado el usuario  [".$name."]",
              'level' => 'success'
          ]);
      }
}
