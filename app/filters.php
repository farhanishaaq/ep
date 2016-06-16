<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	//
});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function($request)
{
	/*echo 'Name: '.$request->getName().'<br >';
	echo 'ActionName : '.$request->getActionName().'<br >';
	echo 'URI: '.$request->getUri().'<br >';
//	$request->getUri();
	;die;*/
//	print_r(get_class_methods('Illuminate\Routing\Route'));die;

	/*if (Auth::guest())
	{
		if (Request::ajax())
		{
			return Response::make('Unauthorized', 401);
		}
		return Redirect::guest('login');
	}*/
	if (Auth::check()){
//		Auth::user()->roles
	}else{
		if (Auth::guest())
		{
			if (Request::ajax())
			{
				return Response::make('Unauthorized', 401);
			}
			return Redirect::guest('login');
		}
	}
});


Route::filter('auth.basic', function()
{
	return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() !== Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});


///////////////////////// CUSTOM FILTERS //////////////////////

Route::filter('Doctor', function()
{ 
  if ( Auth::user()->role !== 'Doctor') {
	    if ( Auth::user()->role == 'Administrator'){
//	    	return Redirect::to('adminHome');
	 	}
	 	else if ( Auth::user()->role == 'Accountant'){
	    	return Redirect::to('accountantHome');
	 	}
	 	else if ( Auth::user()->role == 'Lab Manager'){
	    	return Redirect::to('labManagerHome');
	 	}
	 	else if ( Auth::user()->role == 'Receptionist'){
	    	return Redirect::to('receptionistHome');
	 	}
        else if ( Auth::user()->role == 'Super'){
            return Redirect::to('superHome');
        }
	}else{
		Redirect::to('doctorHome');
	}
});

Route::filter('Super', function()
{
    if ( Auth::user()->role !== 'Super User') {
        if ( Auth::user()->role == 'Doctor'){
            return Redirect::to('doctorHome');
        }
        else if ( Auth::user()->role == 'Accountant'){
            return Redirect::to('accountantHome');
        }
        else if ( Auth::user()->role == 'Lab Manager'){
            return Redirect::to('labManagerHome');
        }
        else if ( Auth::user()->role == 'Receptionist'){
            return Redirect::to('receptionistHome');
        }else if ( Auth::user()->role == 'Administrator'){
            return Redirect::to('adminHome');
        }
    }
});

Route::filter('Administrator', function()
{
    if ( Auth::user()->role !== 'Administrator') {
        if ( Auth::user()->role == 'Doctor'){
            return Redirect::to('doctorHome');
        }
        else if ( Auth::user()->role == 'Accountant'){
            return Redirect::to('accountantHome');
        }
        else if ( Auth::user()->role == 'Lab Manager'){
            return Redirect::to('labManagerHome');
        }
        else if ( Auth::user()->role == 'Receptionist'){
            return Redirect::to('receptionistHome');
        }
        else if ( Auth::user()->role == 'Super'){
            return Redirect::to('superHome');
        }
    }
});

Route::filter('Accountant', function()
{ 
  if ( Auth::user()->role !== 'Accountant') {
    if ( Auth::user()->role == 'Doctor'){
    	return Redirect::to('doctorHome');
 	}
 	else if ( Auth::user()->role == 'Administrator'){
    	return Redirect::to('adminHome');
 	}
 	else if ( Auth::user()->role == 'Lab Manager'){
    	return Redirect::to('labManagerHome');
 	}
 	else if ( Auth::user()->role == 'Receptionist'){
    	return Redirect::to('receptionistHome');
 	}
    else if ( Auth::user()->role == 'Super'){
        return Redirect::to('superHome');
    }
}});

Route::filter('Lab', function()
{ 
  if ( Auth::user()->role !== 'Lab Manager') {
    if ( Auth::user()->role == 'Doctor'){
    	return Redirect::to('doctorHome');
 	}
 	else if ( Auth::user()->role == 'Administrator'){
    	return Redirect::to('adminHome');
 	}
 	else if ( Auth::user()->role == 'Accountant'){
    	return Redirect::to('accountantHome');
 	}
 	else if ( Auth::user()->role == 'Receptionist'){
    	return Redirect::to('receptionistHome');
 	}
    else if ( Auth::user()->role == 'Super'){
        return Redirect::to('superHome');
    }
}});

Route::filter('Receptionist', function()
{ 
//  if ( Auth::user()->role !== 'Receptionist') {
//    if ( Auth::user()->role == 'Doctor'){
//    	return Redirect::to('doctorHome');
// 	}
// 	else if ( Auth::user()->role == 'Administrator'){
//    	return Redirect::to('adminHome');
// 	}
// 	else if ( Auth::user()->role == 'Accountant'){
//    	return Redirect::to('accountantHome');
// 	}
// 	else if ( Auth::user()->role == 'Lab Manager'){
//    	return Redirect::to('labManagerHome');
// 	}
//    else if ( Auth::user()->role == 'Super'){
//        return Redirect::to('superHome');
//    }
//}
});