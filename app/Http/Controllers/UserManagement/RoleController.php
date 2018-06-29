<?php

namespace App\Http\Controllers\UserManagement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\DataTables\Master\RoleDataTable;
use App\Models\Master\Menu;
use App\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(RoleDataTable $dataTable)
    {
        return $dataTable->render('contents.masters.roles.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Menu::getPermission();
        return view( 'contents.masters.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $permissions = null;
            foreach ($request->permissions as $key => $permission) {
                $permissions[$permission] = true;
            }

            $request->merge(['company_id' => @user_info()->company->id, 'permissions' => $permissions]);
            $roles = Role::create( $request->all() );

            flash()->success('Data is successfully created');
            return redirect()->route('role.index');
        } catch (\Exception $e) {

        }
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permissions = Menu::getPermission();
        $role = Role::find($id);

        $rolePermissions = collect($role->permissions);
        $rolePermissionss = [];
        $x = 0;
        foreach ($rolePermissions as $key => $permission) {
            $rolePermissionss[$x] = $key;
            $x++;
        }
        $role->permissions = $rolePermissionss;
        return view( 'contents.masters.roles.edit', compact('role', 'permissions') );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $permissions = null;
            foreach ($request->permissions as $key => $permission) {
                $permissions[$permission] = true;
            }

            $request->merge(['company_id' => @user_info()->company->id, 'permissions' => $permissions]);

            $role = Role::find($id)->update( $request->all() );
            flash()->success('Data is successfully updated');
            return redirect()->route('role.index');
        } catch (\Exception $e) {

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::find($id)->delete();
        flash()->success('Data is successfully deleted');
        return redirect()->back();
    }
}
