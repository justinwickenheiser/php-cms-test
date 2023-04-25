<?php

namespace GvsuWebTeam\Cms\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

use GvsuWebTeam\Singlesignon\Facades\SSO;
use GvsuWebTeam\Cms\Models\User;

class AuthenticationController extends Controller
{
	public function create(Request $request)
	{
        SSO::call();

		if ( SSO::isLoggedIn() ) {

			// They passed CAS - SSO. Now check for them in the table specifically.
			$cmsAdmin = User::where('username', '=', strtolower( SSO::username() ))->first();
			if ($cmsAdmin !== null) {
                // Update their profile info
                $cmsAdmin->first_name = SSO::firstName();
                $cmsAdmin->last_name = SSO::lastName();
                $cmsAdmin->email = strtolower( SSO::email() );
                // $cmsAdmin->last_login = now()->toDateTimeString();
                $cmsAdmin->save();

                // User exists, log them in
                Auth::login($cmsAdmin);
            } else {
                return redirect(route('cms.admin.logout'))->with('error', 'Invalid login');
            }

            // Regenerate session ids for security
            $request->session()->regenerate();
            return redirect(route('cms.admin.site.index'));
		} else {

		}
	}

	public function destroy(Request $request)
	{
        // Logout of laravel
		Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
		
        // Logout of SSO and redirect to login
        SSO::logout(route('cms.admin.login'));
	}
}
