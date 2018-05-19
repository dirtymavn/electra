<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Sentinel;

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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $remember =  (bool) $request->input( 'remember_me' );
            if ( ! Sentinel::authenticate( $request->all() ) ) {
                flash()->error( 'Wrong email or username!' );
                return redirect()->back()->withInput();
            }

            return redirect()->route('admin.dashboard.index');
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
        return redirect()->route( 'admin.login' );
    }
}
