<?php

namespace App\Http\Middleware;

use Closure;
use Sentinel;

class SentinelHasAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string    $permission
     * @return mixed
     */
    public function handle($request, Closure $next, $permission,
        $permission1 = null, $permission2 = null, $permission3 = null,
        $permission4 = null, $permission5 = null, $permission6 = null,
        $permission7 = null, $permission8 = null, $permission9 = null,
        $permission10 = null)
    {
        if ( $user = Sentinel::check() ) {
            if( Sentinel::getUser()->status == 1 ){
                if( ! $user->isSuperAdmin() ) {
                    $permissions = [
                        $permission, $permission1, $permission2, $permission3, $permission4,
                        $permission5, $permission6, $permission7, $permission8, $permission9,
                        $permission10
                    ];

                    if ( ! $user->hasAnyAccess($permissions) ) {
                        if ($request->ajax() || $request->wantsJson()) {
                            return response('Unauthorized.', 403);
                        }

                        flash()->error('Your dont have permission!');
                        return redirect()->route('dashboard');
                    }
                }
            } else{
                flash()->error( 'Your account is suspend!' );
                return redirect()->back()->withInput();
            }
        } else {
            return redirect()->route('admin.login');
        }
        return $next($request);
    }
}
