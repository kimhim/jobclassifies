<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use App;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
	const LIST_NUMBER = 10;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
//     public function __construct()
//     {
//         $this->middleware('auth');
//     }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($displayNumber=null)
    {
    	if ($displayNumber === null) {
    		$displayNumber = self::LIST_NUMBER;
    	}
    	$jobs = DB::table('jobs AS j')
    				->select('j.job_title','j.job_closing_date','j.job_description','j.id','j.job_priority','u.name','u.id AS user_id')
    				->join('users AS u','j.company_id','=','u.id')
    				->where('j.job_status','=',1)
    				->orderBy('j.updated_at','desc')
    				->paginate($displayNumber);
    	$latest_job = DB::table('jobs')
    					->where('job_status','=',1)
    					->limit(5)->orderBy('updated_at','desc')->get();
        return view('welcome',['jobs_list'=>$jobs,'lastest_job'=>$latest_job]);
    }
    
    /**
     * Generate pdf file for download.
     * @return pdf file to download
     * @author KIMHIM HOM
     */
    
    public function generatepdf(){
    	//$pdf = app('dompdf.wrapper');
//     	$data = array('');
// 		$pdf->loadView('resume_pdf',compact('data'),array(''),'UTF-8');
// 		return $pdf->download();
// 		return view('resume_pdf',array('user'=>Auth::user()));
		return PDF::loadView('resume_pdf',array('user'=>Auth::user()))->save('cv/myresume.pdf')->stream('myresume.pdf');
//     	$role_id = Auth::user()->user_role;
//     	$role_title = DB::table('user_roles')
// 			    	->select('title')
// 			    	->where('id','=',$role_id)
// 			    	->get();
//     	return PDF::loadView('resume_pdf',array('user' =>Auth::user(),'user_role'=>$role_title))->save('cv/MyCV.pdf')->stream('MYCV.pdf');
    }
}
