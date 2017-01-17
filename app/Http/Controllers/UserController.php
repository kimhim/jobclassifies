<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Mail;
use Session;
use Illuminate\Support\Facades\File;

class UserController extends Controller {
	
	const LIST_NUMBER=10;

	/**
	 * Register new user
	 * 
	 * @return Ambigous <\Illuminate\View\View, \Illuminate\Contracts\View\Factory>
	 */
	public function registerUser() {
		$user_roles = DB::table ( 'user_roles' )->select ( 'id', 'title' )->where ( 'id', '!=', 1 )->get ();
		return view ( 'auth/register', [ 
				'user_roles' => $user_roles 
		] );
	}
	
	
	/**
	 * 
	 * @param Request $request
	 * @return Ambigous <\Illuminate\Routing\Redirector, \Illuminate\Http\RedirectResponse>
	 */
	
	public function registration(Request $request){
		$this->validate ( $request, [
				'name' => 'required|max:255',
				'email' => 'required|email|max:255|unique:users',
				'user_role' => 'required',
				'password' => 'required|min:6|confirmed'
		]);
		$data = array(
				'name' =>Input::get('name'),
				'email' =>Input::get('email'),
				'user_role' => Input::get('user_role'),
				'password'=>bcrypt(Input::get('password')),
		);
		try{
			$user = User::create([
					'name' =>$data['name'],
					'email' => $data ['email'],
					'user_role' => $data['user_role'],
					'password' =>$data['password'],
					'code'=> str_random(30),
			]);
			// send verification mail to user
			// ---------------------------------------------------------
			$data['code'] = $user->code;
			Mail::send ('user.verification',$data, function ($message) use($data){
				$message->from('no-reply@cambodian-job.com', "Cambodian Job Urgency");
				$message->subject("Register verification");
				$message->to($data['email']);
			});
			if(Auth::check() && Auth::user()->user_role==1){
				return redirect()->route('user.list')
							->with('success',true)
							->with('message','An email sent to '.$data["email"].', Please check and click on a link to verify your account.');
			}
			return redirect()->route('user.profile')
									->with('success',true)
									->with('message','An email sent to '.$data["email"].', Please check and click on a link to verify your account.');
		}catch (\Exception $e){
			return redirect ()->route ( 'page.home' )->with ( 'success', false )->with ( 'message', 'Problem found! ==>' . $e );
		}
	}
	
	/**
	 * 
	 * @param unknown $code
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function userVerify($code){
		$user_found = DB::table('users')->where('code','=',$code)->count();
		$data = array('status'=>1);
		$udpate_status = DB::table('users')->where('code','=',$code)->update($data);
		if($user_found && $udpate_status){
			return redirect()->route('page.home')
						 ->with('success',true)
						 ->with('message','Your acount has been activated successfuly.');
		}else{
			return redirect()->route('page.home')
							 ->with('success',false)
							 ->with('message','Your account already activated.');
		}
	}
	
	/**
	 * To check availability of email registration
	 * 
	 * @param
	 *        	NULL
	 * @return result
	 */
	public function emailValidation() {
		$email = Input::get( 'email' );
		$result = DB::table( 'users' )->where( 'email', '=',$email)->count();
		return $result;
	}
}
