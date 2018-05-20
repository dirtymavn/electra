<?php

namespace App\Http\Controllers\UserManagement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\UserManagement\UserDataTable;

use Sentinel;

class UserController extends Controller
{
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
        return view('contents.user_managements.user.create');
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
            $user = Sentinel::registerAndActivate( $request->all() );

            Sentinel::findRoleBySlug( 'admin' )->users()->attach( $user );
            flash()->success( trans('message.user.create-success') );
            
            return redirect()->route( 'user.index' );
        } catch (Exception $e) {
            flash()->error( trans('message.user.create-error') );
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('contents.user_managements.user.edit', compact('user'));
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
            $user_find = User::find($id);
            $user = Sentinel::update( $user_find, $request->all() );
           
            if(!empty($request->role)){
                Sentinel::findRoleBySlug( $user_find->roles()->first()->slug )->users()->detach($user);
                Sentinel::findRoleBySlug( $request->role )->users()->attach( $user );
            }

            flash()->success( trans('message.user.update-success') );
            return redirect()->route( 'user.index' );
        } catch (Exception $e) {
            flash()->error( trans('message.user.update-error') );
            return back()->withInput();
        }
    }
}
