<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Sentinel;
use App\Models\User;
use App\Models\Internals\MasterProfile;
use App\Http\Requests\Auth\ProfileRequest;

class AuthController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contents.auths.login');
    }

    /**
     * Show the form for forgot password.
     *
     * @return \Illuminate\Http\Response
     */
    public function forgot()
    {
        return view('contents.auths.forgot');
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
            
            $remember = (bool) $request->input('remember_me');
            if (!Sentinel::authenticate($request->all())) {
                flash()->error('Wrong username or password!');
                return redirect()->back()->withInput();
            }

            return redirect()->route('dashboard');
        } catch (\Exception $e) {
            return redirect()->back()->withInput();
        }
    }

    /**
     * Logout from apps
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        Sentinel::logout();
        return redirect()->route( 'auth.login' );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        $user = user_info();

        $user->company_name = @$user->company->name;
        $masterProfile = $user->masterProfile;
        if ($masterProfile) {
            $masterProfile = $user->masterProfile->toArray();
            $userTemp = $user->masterProfile->toArray();
            unset($userTemp['company'], $userTemp['master_profile'], $masterProfile['id'], $userTemp['branch_id']);

            $arrayMerge = array_merge($userTemp, $masterProfile);

            $user = (object) $arrayMerge;   
        }
        // wew($user->branch);
        $branchs = $user->branch()->select('branch_name', 'id')->pluck('branch_name', 'id')->all();

        // wew($branchs);

        return view('contents.auths.profile', compact('user', 'branchs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Auth\ProfileRequest  $request
     * @param  integer  $id
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(ProfileRequest $request, $id)
    {
        try {
            $user = User::find($id);
            $dataInput = $request->except(['_method', '_token', 'email', 'conf_password', 'company_name']);
            
            if (@$request->avatar) {
                if ($user->avatar) {
                    delete_file($user->avatar);
                }

                $uploadAvatar = upload_file($request->avatar, 'uploads/users/avatar/');
                $avatar = $uploadAvatar['original'];

                $dataInput['avatar'] = $avatar;
            }

            if ($request->password == 'default1234') {
                unset($dataInput['password']);
                $updateUser = $user->update($dataInput);
            } else {
                $updateUser = Sentinel::update($user, $dataInput);
            }

            if ($user->masterProfile) {
                $user->masterProfile->update($dataInput);
            } else {
                $request->merge(['company_id' => user_info('company_id'), 'user_id' => user_info('id')]);
                MasterProfile::create($request->except(['_method', '_token', 'conf_password', 'company_name']));
            }

            flash()->success('Profile is successfully updated');
            return redirect()->back();
        } catch (\Exception $e) {
            wew($e->getMessage());
            flash()->error('<strong>Whoops! </strong> Something went wrong');
            return redirect()->back()->withInput();
        }
    }
}
