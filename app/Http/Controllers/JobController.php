<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use App\Job;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use App\User;
use Illuminate\Support\Facades\Mail;

class JobController extends Controller {
	
	const LIST_NUMBER = 10;
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		//$this->middleware ( 'auth' );
	}
	
	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index($displayNumber = null) {
		if ($displayNumber === null) {
    		$displayNumber = self::LIST_NUMBER;
    	}
		//If user is not administration
		if (Auth::user ()->user_role == 3) {
			return redirect ()->route ( 'page.home' )->with ( 'success',false)->with ( 'message', 'Your have no permission to access this page.' );
		}
		$data = DB::table ( 'jobs AS j' )
						->select(
								'j.job_title','j.id','j.job_description','j.created_at AS job_posted_date',
								'j.job_closing_date','u.name AS company_name','j.job_status','j.job_categories'
								)
						->join('users AS u','j.company_id','=','u.id')
						->orderBy ( 'j.updated_at','desc')->paginate($displayNumber);
		
		if(Auth::user()->user_role==2){
			$data = DB::table ( 'jobs AS j' )
						->select(
								'j.company_id','j.job_title','j.id','j.job_description','j.created_at AS job_posted_date',
								'j.job_closing_date','u.name AS company_name','j.job_status','j.job_categories'
						)
						->join('users AS u','j.company_id','=','u.id')
						->where('j.company_id','=',Auth::user()->id)
						->orderBy ( 'j.updated_at','desc')->paginate($displayNumber);
		}
		
		return view ( 'job.list',['job_list' => $data]);
	}
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		return view ( 'job.add' );
	}
	
	/**
	 * Store a newly created resource in storage.
	 *
	 * @param \Illuminate\Http\Request $request        	
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		$data = Input::all ();
		if (isset ( $data ['btn-post-job'] )) {
			$this->validate ( $request, [ 
					'job_title' => 'required',
					'job_description' => 'required|max:100',
					'job_requirement' => 'required',
					'job_categories' => 'required',
					'job_closing_date' => 'required',
					'job_priority' => 'required' 
			] );
			try {
				$data = array (
						'job_title' => trim ( Input::get ( 'job_title' ) ),
						'job_description' => trim ( Input::get ( 'job_description' ) ),
						'job_requirement' => trim ( Input::get ( 'job_requirement' ) ),
						'job_categories' => Input::get ( 'job_categories' ),
						'job_closing_date' => Input::get ( 'job_closing_date' ),
						'job_priority' => Input::get ( 'job_priority' ),
						'company_id'=>Auth::user()->id
				);
				$result = Job::create ( $data );
				return redirect ()->route ( 'job.list' )->with ( 'success', true )->with ( 'message', 'Your job has been saved into database succesfully.' );
			} catch ( \Exception $e ) {
				return redirect ()->route ( 'job.list' )->with ( 'success', false )->with ( 'message', 'Problem udpate! ==>' . $e );
			}
		}
	}
	
	/**
	 * Display the specified resource.
	 *
	 * @param int $id        	
	 * @return \Illuminate\Http\Response
	 */
	public function show($id) {
		$detail_job = DB::table ( 'jobs AS j' );
		$detail_job->select ( 
				'u.name', 'j.job_title', 'j.job_description', 
				'j.job_requirement', 'j.job_categories', 'j.job_closing_date',
				'j.job_priority','u.id AS user_id',
				'j.id','j.company_id'
				);
		$detail_job->join ( 'users AS u', 'u.id', '=', 'j.company_id' );
		$detail_job->where ( 'j.id', $id );
		$result = $detail_job->get();
		return view ( 'job.detail' )->with ( 'detail_job', $result );
	}
	
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param int $id        	
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		$job_edit = Job::find($id);
		return view('job.edit',['job_edit'=>$job_edit]);
	}
	
	/**
	 * Update the specified resource in storage.
	 *
	 * @param \Illuminate\Http\Request $request        	
	 * @param int $id        	
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {
		$data = Input::all ();
		if (isset ( $data ['btn-update-job'] )) {
			$this->validate ( $request, [ 
					'job_title' => 'required',
					'job_description' => 'required|max:100',
					'job_requirement' => 'required',
					'job_categories' => 'required',
					'job_closing_date' => 'required',
					'job_priority' => 'required' 
			] );
			try {
				$data = array (
						'job_title' => trim ( Input::get ( 'job_title' ) ),
						'job_description' => trim ( Input::get ( 'job_description' ) ),
						'job_requirement' => trim ( Input::get ( 'job_requirement' ) ),
						'job_categories' => Input::get ( 'job_categories' ),
						'job_closing_date' => Input::get ( 'job_closing_date' ),
						'job_priority' => Input::get ( 'job_priority' ),
						'company_id'=>Auth::user()->id
				);
				$result = DB::table('jobs')
							->where('id','=',$id)	
							->update($data);
				return redirect ()->route ( 'job.list' )->with ( 'success', true )->with ( 'message', 'Your job has been saved into database succesfully.' );
			} catch ( \Exception $e ) {
				return redirect ()->route ( 'job.list' )->with ( 'success', false )->with ( 'message', 'Problem udpate! ==>' . $e );
			}
		}
	}
	
	/**
	 * 
	 * @param unknown $job_id
	 * @param unknown $job_status
	 * @return \Illuminate\Http\RedirectResponse
	 */
	
	public function update_status($job_id,$job_status){
		$status_message = $job_status==1?'Disabled':'Enabled';
		$staus = $job_status==1?0:1;
		$data = array('job_status'=>$staus);
		try {
			$update_job = DB::table('jobs')
							->where('id','=',$job_id)
							->update($data);
			if($update_job){
				return redirect()->route('job.list')
								->with('success',true)
								->with('message','One Job has been '.$status_message.' successfuly.');
			}
		} catch ( \Exception $e ) {
			return redirect ()->route ( 'job.list' )->with ( 'success', false )->with ( 'message', 'Problem udpate! ==>' . $e );
		}
	}
	
		
	/**
	 * 
	 * @param unknown $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	
		public function delete($id){
			try{
				DB::table('jobs')
					->where('id','=',$id)
					->delete();
				return redirect()->route('job.list')
					->with('success',true)
					->with('message','One job has been deleted from database successfully');
			}catch ( \Exception $e){
				return redirect ()->route ( 'job.list' )->with ( 'success', false )->with ( 'message', 'Problem udpate! ==>' . $e );
			}
	}
	
	
	public function apply($job_id) {
		$detail_job = DB::table ( 'jobs AS j' );
		$detail_job->select ( 
				'u.name', 'j.job_title', 'j.job_description', 
				'j.job_requirement', 'j.job_categories', 'j.job_closing_date',
				'j.job_priority','u.id AS user_id',
				'j.id','j.company_id','u.email'
				);
		$detail_job->join ( 'users AS u', 'u.id', '=', 'j.company_id' );
		$detail_job->where ( 'j.id', $job_id );
		$result = $detail_job->first();
		$id = Auth::user()->id;
		$name = Auth::user()->name;
		$filename = "$name-$id.pdf";
		$cvpdf = "cv/$name-$id.pdf";
		$user_profile = DB::table('users')
    				->where('id','=',Auth::user()->id)
    				->first();
    	$education = DB::table('education')
    							->where('employee_id','=',Auth::user()->id)
    							->orderBy('created_at','DESC')
    							->get();
    	$work_experience = DB::table('work_experiences')
    						->where('employee_id','=',Auth::user()->id)
    						->orderBy('created_at','DESC')
    						->get();
    	$data = array(
	    	'company_name'=>$result->name,
	    	'company_email'=>$result->email,
	    	'attach_file'=>$filename,
    		'job_title'=>$result->job_title,
    		'employee_name'=>Auth::user()->name,
    		'employee_email'=>Auth::user()->email,
    		'employee_id'=>$result->user_id,
    		'file'=>"cv/$name-$id.pdf"
    	);
    	PDF::loadView('resume_pdf',[
		    	'company_profile'=>$user_profile,
		    	'user'=>Auth::user(),
		    	'education'=>$education,
		    	'work_experience'=>$work_experience
    	])->save($cvpdf);//->stream("$filename.pdf");
    	
    	Mail::send ('employee.applyjob',$data, function ($message) use($data){
    		$message->from('kimhim.hom@gmail.com',$data['employee_name']);
    		$message->to($data['company_email'],$data['company_name']);
    		$message->subject("Application for ".$data['job_title']."");
    		$message->attach($data['file']);
    	});
       return redirect()->route('page.home')
       								->with('success',true)
       								->with('message','You recently applied to '.Auth::user()->name);
	}
}
