<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use App\Education;
use League\Flysystem\Directory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Work_experience;

class EmployeeController extends Controller
{
    
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
    public function index()
    {
        return view('employee.list');
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
       $data = Input::all();
       Education::create([
       				'school'=>trim(Input::get('school')),
       				'start_year'=>Input::get('start_year'),
       				'finish_year'=>Input::get('finish_year'),
       				'major'=>Input::get('major'),
       				'employee_id'=>Auth::user()->id
       				]);
       return redirect()->route('user.profile')
       						->with('success',true)
       						->with('message','Your education has been saved succesfuly.');
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
    public function edit()
    {
    	$id = Input::get('education_id');
      	$data = Education::where('id','=',$id)->get();
      	return view('employee.edit',['data'=>$data[0]]);
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
        $data = array(
        		'school'=>trim(Input::get('school')),
        		'start_year'=>Input::get('start_year'),
        		'finish_year'=>Input::get('finish_year'),
        		'major'=>trim(Input::get('major'))
        );
        $update = Education::find($id)->update($data);
        if($update){
        	return redirect()->route('user.profile')
        					->with('success',true)
        					->with('message','Your eduction has been updated succesfuly.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
    	try{
			DB::table('education')
				->where('id','=',$id)
				->delete();
			return redirect()->route('user.profile')
				->with('success',true)
				->with('message','One education has been deleted from database successfully');
		}catch ( \Exception $e){
			return redirect ()->route ( 'user.profile' )->with ( 'success', false )->with ( 'message', 'Problem udpate! ==>' . $e );
		}
    }
    
    
    //============Work Experience==========
    
    public function saveWorkexperience(Request $request){
    	try{
    		$this->validate ( $request, [
    			'company_name' => 'required',
    			'start_date' => 'required',
    			'finish_date' => 'required',
    			'position' => 'required'
	    	] );
    		$finish_date = Input::get('finish_date');
    		if((strtotime(trim(Input::get('finish_date')))== (strtotime(date("M-Y"))) ) ){
    			$finish_date = 'Present';
    		}
	    	Work_experience::create(
						    	[
					    			'company_name' =>trim(Input::get('company_name')),
					    			'start_date' =>Input::get('start_date'),
					    			'finish_date' =>$finish_date,
					    			'position' => Input::get('position'),
					    			'employee_id' =>Auth::user()->id
						    	]);
    		return redirect()->route('user.profile')
    		->with('success',true)
    		->with('message','Your work experience has been saved successfully');
    	}catch ( \Exception $e){
    		return redirect ()->route ( 'user.profile' )->with ( 'success', false )->with ( 'message', 'Problem udpate! ==>' . $e );
    	}
    }
    
    /**
     * 
     * @return Ambigous <\Illuminate\View\View, \Illuminate\Contracts\View\Factory>
     */
    public function editWorkexperience(){
    
    	try{
    			$id = Input::get('work_experience_id');
		    	$data = Work_experience::where('id','=',$id)->get();
		    	return view('employee.edit_work_experience',['data'=>$data[0]]);
    	}catch ( \Exception $e){
    		return redirect ()->route ( 'user.profile' )->with ( 'success', false )->with ( 'message', 'Problem udpate! ==>' . $e );
    	}
    }
    
    public function updateWorkexperience($id){
    	try{
    		$finish_date = Input::get('finish_date');
    		if((strtotime(trim(Input::get('finish_date')))== (strtotime(date("M-Y"))) ) ){
    			$finish_date = 'Present';
    		}
    		
    		$data = array(
    				'company_name'=>trim(Input::get('company_name')),
    				'start_date'=>Input::get('start_date'),
    				'finish_date'=>$finish_date,
    				'position'=>trim(Input::get('position'))
    		);
    		$update = Work_experience::find($id)->update($data);
    		if($update){
    			return redirect()->route('user.profile')
    			->with('success',true)
    			->with('message','Your eduction has been updated succesfuly.');
    		}
    	}catch (\Exception $e){
    		return redirect ()->route ( 'user.profile' )->with ( 'success', false )->with ( 'message', 'Problem udpate! ==>' . $e );
    	}
    }
    
    /**
     * 
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteWorkexperience($id){
    	try{
    		DB::table('work_experiences')
    		->where('id','=',$id)
    		->delete();
    		return redirect()->route('user.profile')
    		->with('success',true)
    		->with('message','One of your work experience has been deleted from database successfully');
    	}catch ( \Exception $e){
    		return redirect ()->route ( 'user.profile' )->with ( 'success', false )->with ( 'message', 'Problem udpate! ==>' . $e );
    	}
    }
}
