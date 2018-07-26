<?php

namespace App\Http\Controllers\UserManagement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\UserManagement\UserDataTable;

use Sentinel;
use App\Models\User;
use App\Models\Role;
use App\Models\Master\Company;
use App\Models\MasterData\Branch;
use App\Models\MasterData\Department;
use App\Http\Requests\UserManagement\UserRequest;
use App\Mail\UserManagement\ResetPassword;
use Mail;

class UserController extends Controller
{
    /**
     * @var \App\Models\User
     * @var \App\Models\Role
     * @var \App\Models\Master\Company
    */
    protected $user;
    protected $role;
    protected $company;

    /**
     * Create a new UserController instance.
     *
     * @param \App\Models\User  $user
     * @param \App\Models\Role  $role
     * @param \App\Models\Master\Company  $company
    */
    public function __construct(User $user, Company $company, Role $role)
    {
        $this->user = $user;
        $this->company = $company;
        $this->role = $role;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UserDataTable $dataTable)
    {
        return $dataTable->render('contents.user_managements.user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (@user_info()->company) {
            $companies = user_info()->company()->pluck('name', 'id')->all();
        } else {
            $companies = $this->company->getData()->pluck('name', 'id')->all();
        }

        $branchs = Branch::getAvailableData()->pluck('branch_name', 'company_branchs.id')->all();
        $departments = Department::getAvailableData()->pluck('department_name', 'company_departments.id')->all();

        // $roles = Role::whereNotIn('slug', ['super-admin'])->pluck('name', 'slug')->all();
        $roles = $this->getRoleUsers(user_info('roles')[0]->slug);

        return view('contents.user_managements.user.create', compact('companies', 'roles', 'branchs', 'departments'));
    }

    protected function getRoleUsers($role)
    {
        if ($role == 'super-admin') {
            $roles = Role::whereSlug('admin')->pluck('name', 'slug')->all();
        } elseif ($role == 'admin') {
            $roles = Role::whereCompanyId(user_info()->company->id)->pluck('name', 'slug')->all();
        } else {
            $roles = Role::whereCompanyId(user_info()->company->id)
                ->where('slug', '<>', user_info('roles')[0]->slug)
                ->pluck('name', 'slug')->all();
        }

        return $roles;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\UserManagement\UserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        \DB::beginTransaction();
        try {
            if (user_info('company_role') == 'super-admin') {
                $companyRole = 'admin';
                $parentId = null;
            } else {
                $companyRole = $request->role_id;
                $parentId = (user_info('parent_id')) ? user_info('parent_id') : user_info()->id;
            }
            
            $request->merge(['company_role' => $companyRole, 'parent_id' => $parentId, 'status' => 1]);
            $user = Sentinel::registerAndActivate( $request->all() );

            Sentinel::findRoleBySlug( $request->role_id )->users()->attach( $user );
            flash()->success( trans('message.create.success') );

            \DB::commit();

            return redirect()->route( 'user.index' );
        } catch (Exception $e) {
            flash()->error( trans('message.error') );
            \DB::rollback();
            return back()->withInput();
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
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $user->role_id = $user->roles[0]->slug;
        $companies = $user->company()->pluck('name', 'id')->all();
        // $roles = Role::whereNotIn('slug', ['super-admin'])->pluck('name', 'slug')->all();
        $roles = $this->getRoleUsers(user_info('roles')[0]->slug);

        $branchs = Branch::getAvailableData()->pluck('branch_name', 'company_branchs.id')->all();
        $departments = Department::getAvailableData()->pluck('department_name', 'company_departments.id')->all();

        return view('contents.user_managements.user.edit', compact('user', 'companies', 'roles', 'branchs', 'departments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UserManagement\UserRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        try {
            $user_find = User::find($id);
            if (!empty(@$request->password)) {
                $user = Sentinel::update( $user_find, $request->all() );
            } else {
                $user = $user_find->update($request->except(['password']));
            }
           
            if(!empty($request->role_id)){
                $companyRole = $request->role_id;

                $user_find->update(['company_role' => $companyRole]);

                Sentinel::findRoleBySlug( $user_find->roles()->first()->slug )->users()->detach($user_find);
                Sentinel::findRoleBySlug( $request->role_id )->users()->attach( $user_find );
            }

            flash()->success( trans('message.update.success') );
            return redirect()->route( 'user.index' );
        } catch (Exception $e) {
            flash()->error( trans('message.error') );
            return back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if ($user->childs->count() > 0 || $user->company_role == 'super-admin' || ($user->company_role == 'admin' && !user_info()->inRole('super-admin'))) {
            // cannot delete, user have childs, super-admin, and admin of company
            flash()->error(trans('message.have_related'));
        } else {
            $user->delete();
            flash()->success(trans('message.delete.success'));
        }
        return redirect()->back();
    }

    /**
     * Reset Password the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function resetPassword($id)
    {
        $user = $this->user->find($id);
        if ($user) {
            $newPassword = $this->generateRandomString(8);
            $message = 'Your password has been reset, this is your new password : ' . $newPassword;
            $updatePassword = Sentinel::update($user, ['password' => $newPassword]);
            if ($updatePassword) {
                Mail::to($user->email)->send(new ResetPassword(['message' => $message, 'name' => $user->first_name.' '.$user->last_name]));
                flash()->success(trans('Password has been reseted, new password has sent by email'));
            } else {
                flash()->success(trans('message.error'));
            }
            return redirect()->route('user.index');
        } else {
            flash()->info(trans('message.not_found'));
            return redirect()->route('user.index');
        }
    }
}
