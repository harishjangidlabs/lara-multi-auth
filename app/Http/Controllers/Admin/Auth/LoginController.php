<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
	use AuthenticatesUsers;


	public function __construct(){
		$this->middleware('guest:admin')->except('logout');
	}

	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
    public function showLoginForm(){
	    return view('admin.login');
    }

	/**
	 * @param Request $request
	 *
	 * @return $this|\Illuminate\Http\RedirectResponse
	 */
	public function login(Request $request){

		//Validate the form data

		$this->validate($request,[
			'email' => 'required|email',
			'password' => 'required|min:6'
		]);

		//Attempt to logged the user in
		$credentials = ['email'=>$request->email,'password'=>$request->password];
		if(Auth::guard('admin')->attempt($credentials,$request->remember)){

			//If Successful then redirect to their intended location
			return redirect()->intended(route('admin.dashboard'));

		}

		//if Unsuccessful, then redirect back to login with the form data
		return redirect()->back()->withInput($request->only('email','remember'));

	}

	/**
	 * Log the user out of the application.
	 *
	 * @param Request $request
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function logout(Request $request){

		Auth::guard('admin')->logout();

		$request->session()->flash('status','Logout Successfully!');

		$request->session()->regenerate();

		return redirect()->guest(route('admin.login'));
	}

	/**
	 * @return mixed
	 */
	protected function guard()
	{
		return Auth::guard('admin');
	}


}
