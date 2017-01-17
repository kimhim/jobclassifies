<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Illuminate\Support\Facades\File;

class EmployerController extends Controller
{
	const LIST_NUMBER = 10;
	
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
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
    public function index($displayNumber=null)
    {
    	if ($displayNumber === null) {
    		$displayNumber = self::LIST_NUMBER;
    	}
    	$employees_list = DB::table('users')
    					->where('user_role','!=',1)
    					->orderBy('updated_at','desc')
    					->paginate($displayNumber);
        return view('employer.list',['employer_list'=>$employees_list]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    	$data = DB::table('users')
    				->where('id','=',$id)
    				->first();
    	$job_of_company = DB::table('jobs')
    					->where('company_id','=',$id)
    					->orderBy('updated_at','desc')
    					->paginate($displayNumber);
       return view('employer.view',['company_profile'=>$data,'job_of_compnay'=>$job_of_company]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }
    
    public function delete($id){
    	$user_avata  = DB::table('users')
    					->select('avatar')
    					->where('id','=',$id)
    					->get();
    	$user_image = $user_avata[0]->avatar;
    	if($user_image){
    		File::delete('images/avatars/' . $user_image);
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
    	return redirect()->route('employer.list')
				    	->with('success',true)
				    	->with('message','One user has been deleted successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
