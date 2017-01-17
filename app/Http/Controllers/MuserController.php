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
use Image;
use Illuminate\Support\Facades\File;

class MuserController extends Controller
{

	const LIST_NUMBER=10;
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('auth');
	}
	
	public function index(){
		return view('auth.login');
	}
	public function listUser($displayNumber = null) {
		if ($displayNumber === null) {
			$displayNumber = self::LIST_NUMBER;
		}
		$users = DB::table ( 'users as user' );
		$users->select ('user.user_role','user.status', 'user.phone', 'user.address', 'user.id', 'user.name', 'user.email', 'role.title', 'user.created_at', 'user.updated_at', 'user.avatar' );
		$users->join ( 'user_roles AS role', 'user.user_role', '=', 'role.id' );
		$users->where ( 'user.user_role', '!=', 1 );
		$users->orderBy ( 'user.user_role', 'ASC' );
		$result = $users->paginate($displayNumber);
		$user_roles = DB::table ( 'user_roles' )->select ( 'id', 'title' )->where ( 'id', '!=', 1 )->get ();
		return view ( 'user.list', [
				'user_list' => $result,
				'user_roles'=>$user_roles
		] );
	}
	
	
	
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		$user_result = DB::table('users AS u')
		->select('u.id','u.name','u.email','ur.title','u.avatar','u.sex','u.dob','u.phone','u.address','u.description')
		->join('user_roles AS ur','u.user_role','=','ur.id')
		->where('u.id','=',$id)->get();
		return view('user.edit',['user'=>$user_result[0]]);
	}
	
	
	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id,$displayNumber=null)
	{
		if ($displayNumber === null) {
			$displayNumber = self::LIST_NUMBER;
		}
		$data = DB::table('users AS u')
				->select('u.name','u.email','u.description','u.avatar','ur.title')
				->join('user_roles AS ur','u.user_role','=','ur.id')
				->where('u.id','=',$id)
				->first();
		$job_of_company = DB::table('jobs')
		->where('company_id','=',$id)
		->orderBy('updated_at','desc')
		->paginate($displayNumber);
		return view('employer.view',['company_profile'=>$data,'job_of_compnay'=>$job_of_company]);
	}
	
	
	
	
	/**
	 * Show each user profile base on the logged in profile
	 * 
	 * @return Ambigous <\Illuminate\View\View, \Illuminate\Contracts\View\Factory>
	 */
	public function showProfile($displayNumber=null) {
		$role_id = Auth::user ()->user_role;
		$role_title = DB::table ( 'user_roles' )->select ( 'title' )->where ( 'id', '=', $role_id )->get ();
		
		
		if ($displayNumber === null) {
    		$displayNumber = self::LIST_NUMBER;
    	}
    		$data = DB::table('users AS u')
				->select('u.name','u.email','u.description','u.avatar','ur.title')
				->join('user_roles AS ur','u.user_role','=','ur.id')
				->where('u.id','=',Auth::user()->id)
				->first();
    	$job_of_company = DB::table('jobs')
    					->where('company_id','=',Auth::user()->id)
    					->orderBy('updated_at','desc')
    					->paginate($displayNumber);
    	$education = DB::table('education')
    							->where('employee_id','=',Auth::user()->id)
    							->orderBy('created_at','DESC')
    							->get();
    	$work_experience = DB::table('work_experiences')
    						->where('employee_id','=',Auth::user()->id)
    						->orderBy('created_at','DESC')
    						->get();
       return view('user.show_profile',[
       				'company_profile'=>$data,
       				'job_of_company'=>$job_of_company,
       				'user'=>Auth::user(),
       				'user_role'=>$role_title,
       				'education'=>$education,
       				'work_experience'=>$work_experience
       	]);
	}
	
	/**
	 * Edit specific user base on $id
	 * 
	 * @param int $id        	
	 * @return current logged in user profile and title of users'roles
	 */
	public function editProfile() {
		$role_id = Auth::user ()->user_role;
		$role_title = DB::table ( 'user_roles' )->select ( 'title' )->where ( 'id', '=', $role_id )->get ();
		return view ( 'user.edit_profile', array (
				'user' => Auth::user (),
				'user_roles' => $role_title 
		) );
	}
	
	/**
	 *
	 * @param Request $data        	
	 * @param string $id        	
	 */
	public function updateProfile(Request $request) {
		$data = Input::all ();
		if (isset ( $data ['btn-update'] )) {
			$this->validate ( $request, [ 
					'name' => 'required',
					'email' => 'required|email|max:255',
					'sex' => 'required',
					'dob' => 'required',
					'phone' => 'required|numeric',
					'address' => 'required',
					'description'=>'required'
			] );
			try {
				$name= '';
				$user_id = Auth::user()->id;
				if (Input::hasFile ( 'avatar' )) {
					$file = $request->file ( 'avatar' );
					
					$user_avata  = DB::table('users')
										->select('avatar')
										->where('id','=',$user_id)
										->get();
					$user_image = $user_avata[0]->avatar;
					if($user_image && $user_image!='profile_image.png'){
						File::delete('images/avatars/' . $user_image);
						File::delete('images/avatars/thumbnail/' . $user_image);
					}
					if ($file->isValid()){
						$photo = $request->file('avatar');
						$imagename = time().'.'.$photo->getClientOriginalExtension();
						 
						$destinationPath = public_path('images/avatars/thumbnail');
						$thumb_img = Image::make($photo->getRealPath())->resize(120, 150);
						$thumb_img->save($destinationPath.'/'.$imagename,80);
						
						$destinationPath = public_path('images/avatars');
						$photo->move($destinationPath, $imagename);
					}
				}
				
				$data = array (
						'email' => trim ( Input::get ( 'email' ) ),
						'name' => trim ( Input::get ( 'name' ) ),
						'sex' => Input::get ( 'sex' ),
						'dob' => Input::get ( 'dob' ),
						'phone' => Input::get ( 'phone' ),
						'address' => Input::get ( 'address' ),
						'description'=>Input::get('description')
				);
				
				if(Input::hasFile ( 'avatar' )){
					$data = array (
							'email' => trim ( Input::get ( 'email' ) ),
							'name' => trim ( Input::get ( 'name' ) ),
							'sex' => Input::get ( 'sex' ),
							'dob' => Input::get ( 'dob' ),
							'phone' => Input::get ( 'phone' ),
							'address' => Input::get ( 'address' ),
							'description'=>Input::get('description'),
							'avatar'=>$imagename,
					);
				}
				
				//$data = $this->prepareDataBind ( 'edit' );
				$result = DB::table ( 'users' )->where ( 'id', '=', Auth::user ()->id )->update ( $data );
				if (Auth::user ()->user_role == 1) {
					return redirect ()->route ( 'user.profile' )->with ( 'success', 1 )->with ( 'message', 'One user has been updated successfully!' );
				} elseif (Auth::user ()->user_role == 2) {
					return redirect ()->route ( 'user.profile' )->with ( 'success', 1 )->with ( 'message', 'Your profile has been updated successfully!' );
				} else {
					return redirect ()->route ( 'user.profile' )->with ( 'success', 1 )->with ( 'message', 'One user has been updated successfully!' );
				}
			} catch ( \Exception $e ) {
				return redirect ()->route ( 'user.profile' )->with ( 'success', false )->with ( 'message', 'Problem udpate! ==>' . $e );
			}
		}
		
		$role_id = Auth::user ()->user_role;
		$role_title = DB::table ( 'user_roles' )->select ( 'title' )->where ( 'id', '=', $role_id )->get ();
		return view ( 'user.edit_profile', array (
				'user' => Auth::user (),
				'user_roles' => $role_title 
		) );
	}
	
	
	/**
	 * 
	 * @param Request $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function update_user(Request $request){
		$data = Input::all ();
		if (isset ( $data ['btn-update-user'] )) {
			$this->validate ( $request, [
					'name' => 'required',
					'email' => 'required|email|max:255',
					'sex' => 'required',
					'dob' => 'required',
					'phone' => 'required|numeric',
					'address' => 'required',
					'description'=>'required'
			] );
			try {
				$name= '';
				$user_id = Input::get('user_id');
				if (Input::hasFile ( 'avatar' )) {
					$file = $request->file ( 'avatar' );
					$user_avata  = DB::table('users')
									->select('avatar')
									->where('id','=',$user_id)
									->get();
					$user_image = $user_avata[0]->avatar;
					if($user_image && $user_image!='profile_image.png'){
						File::delete('images/avatars/' . $user_image);
						File::delete('images/avatars/thumbnail/' . $user_image);
					}
					
					if ($file->isValid()){
						$photo = $request->file('avatar');
						$imagename = time().'.'.$photo->getClientOriginalExtension();
						 
						$destinationPath = public_path('images/avatars/thumbnail');
						$thumb_img = Image::make($photo->getRealPath())->resize(120, 150);
						$thumb_img->save($destinationPath.'/'.$imagename,80);
						
						$destinationPath = public_path('images/avatars');
						$photo->move($destinationPath, $imagename);
					}
				}
				
				$data = array (
						'email' => trim ( Input::get ( 'email' ) ),
						'name' => trim ( Input::get ( 'name' ) ),
						'sex' => Input::get ( 'sex' ),
						'dob' => Input::get ( 'dob' ),
						'phone' => Input::get ( 'phone' ),
						'address' => Input::get ( 'address' ),
						'description'=>Input::get('description')
				);
				
				if(Input::hasFile ( 'avatar' )){
					$data = array (
							'email' => trim ( Input::get ( 'email' ) ),
							'name' => trim ( Input::get ( 'name' ) ),
							'sex' => Input::get ( 'sex' ),
							'dob' => Input::get ( 'dob' ),
							'phone' => Input::get ( 'phone' ),
							'address' => Input::get ( 'address' ),
							'description'=>Input::get('description'),
							'avatar'=>$imagename,
					);
				}
		
				//$data = $this->prepareDataBind ( 'edit' );
				$result = DB::table ( 'users' )->where ( 'id', '=',$user_id)->update ( $data );
				return redirect ()->route ( 'user.list' )->with ( 'success', 1 )->with ( 'message', 'One user has been updated successfully!' );
				
			} catch ( \Exception $e ) {
				return redirect ()->route ( 'user.profile' )->with ( 'success', false )->with ( 'message', 'Problem udpate! ==>' . $e );
			}
		}
		
		$role_id = Auth::user ()->user_role;
		$role_title = DB::table ( 'user_roles' )->select ( 'title' )->where ( 'id', '=', $role_id )->get ();
		return view ( 'user.edit_profile', array (
				'user' => Auth::user (),
				'user_roles' => $role_title
		) );
	}
	
	
	
	public function udpateStatus($user_id,$user_status){
		$status_message = $user_status==1?'Disabled':'Enabled';
		$staus = $user_status==1?0:1;
		$data = array('status'=>$staus);
		$update_user = DB::table('users')
					->where('id','=',$user_id)	
					->update($data);
		if($update_user){
			return redirect()->route('user.list')
								->with('success',true)
								->with('message','One user has been '.$status_message.' successfuly.');
		}
	}
	/**
	 * 
	 * @param Request $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function changePassword(Request $request) {
		$data = Input::all ();
		if (isset ( $data ['btn-reset-password'] )) {
			$this->validate ( $request, [ 
					'password' => 'required|min:6|confirmed' 
			] );
			try {
				$password = bcrypt ( Input::get ( 'password' ) );
				$data = array (
						'password' => $password 
				);
				$result = DB::table ( 'users' )->where ( 'id', '=', Auth::user ()->id )->update ( $data );
				if (Auth::user ()->user_role == 1) {
					return redirect ()->route ( 'user.list' )->with ( 'success', true )->with ( 'message', 'One user has been updated successfully!' );
				} elseif (Auth::user ()->user_role == 2) {
					return redirect ()->route ( 'user.profile' )->with ( 'success', true )->with ( 'message', 'Your password has been updated successfully!' );
				} else {
					return redirect ()->route ( 'user.profile' )->with ( 'success', true )->with ( 'message', 'One user has been updated successfully!' );
				}
			} catch ( \Exception $e ) {
				return redirect ()->route ( 'user.profile' )->with ( 'success', false )->with ( 'message', 'Problem udpate! ==>' . mysql_error () );
			}
		}
		return view ( 'user.change_password' );
	}
	
	
	
	public function delete($id){
		$user_avata  = DB::table('users')
				->select('avatar')
				->where('id','=',$id)
				->get();
		$user_image = $user_avata[0]->avatar;
		if($user_image){
			File::delete('images/avatars/' . $user_image);
			File::delete('images/avatars/thumbnail/' . $user_image);
		}
		DB::table('users')
		->where('id','=',$id)
		->delete();
		$find_job = DB::table('jobs')->where('company_id','=',$id)->get();
		if($find_job){
			DB::table('jobs')
			->where('company_id','=',$id)
			->delete();
		}
		return redirect()->route('user.list')
							->with('success',true)
							->with('message','One user has been deleted successfully');
	}
}
