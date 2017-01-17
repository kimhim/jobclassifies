<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Mail;
use Session;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Request;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller {
	/*
	 * |--------------------------------------------------------------------------
	 * | Registration & Login Controller
	 * |--------------------------------------------------------------------------
	 * |
	 * | This controller handles the registration of new users, as well as the
	 * | authentication of existing users. By default, this controller uses
	 * | a simple trait to add these behaviors. Why don't you explore it?
	 * |
	 */
	
	use AuthenticatesAndRegistersUsers, ThrottlesLogins;
	
	/**
	 * Where to redirect users after login / registration.
	 *
	 * @var string
	 */
	protected $loginPath = '/login';
	protected $redirectTo = '/';
	protected $redirectAfterLogout = '/login';
	/**
	 * Create a new authentication controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware ( $this->guestMiddleware (), [ 
				'except' => 'logout' 
		] );
	}
	

	/**
	 * Get a validator for an incoming registration request.
	 *
	 * @param  array  $data
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	protected function validator(array $data)
	{
		return Validator::make($data, [
				'name' => 'required|max:255',
				'email' => 'required|email|max:255|unique:users',
				'user_role' => 'required',
				'password' => 'required|min:6|confirmed'
		]);
	}
	
	/**
	 * Create a new user instance after a valid registration.
	 *
	 * @param  array  $data
	 * @return User
	 */
	protected function create(array $data)
	{
		$user = User::create([
				'name' =>$data['name'],
				'email' => $data ['email'],
				'user_role' => $data['user_role'],
				'password' =>bcrypt($data['password']),
				'code'=> str_random(30),
		]);
		
		$data = array(
				'name' =>Input::get('name'),
				'email' =>Input::get('email'),
				'user_role' => Input::get('user_role'),
				'password'=>bcrypt(Input::get('password')),
		);
		
		$data['code'] = $user->code;
		Mail::send ('user.verification',$data, function ($message) use($data){
			$message->from("no-reply@cambodian-job.com", "Cambodian Job Urgency");
			$message->subject("Register verification");
			$message->to($data['email'],"KIMHIM HOM");
		});
		
		return $user;
	}
	
}
