<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::auth();
Route::get('/',['as'=>'page.home','uses'=>'HomeController@index']);


Route::get('user/change_password',['as'=>'user.change_password','uses'=>'MuserController@changePassword']);
Route::post('user/change_password',['as'=>'user.change_password','uses'=>'MuserController@changePassword']);
Route::get('user/register',['as'=>'user.register','uses'=>'UserController@registerUser']);
Route::post('user/register',['as'=>'user.registration','uses'=>'UserController@registration']);
Route::get('user/emailvalidation',['as'=>'user.email-validation','uses'=>'UserController@emailValidation']);

Route::get('user/verification/{code}',['as'=>'user.verify','uses'=>'UserController@userVerify']);


Route::get('user/view_profile',['as'=>'user.profile','uses'=>'MuserController@showProfile']);
Route::get('user/edit_profile',['as'=>'user.edit_profile','uses'=>'MuserController@updateProfile']);
Route::post('user/edit_profile',['as'=>'user.edit_profile','uses'=>'MuserController@updateProfile']);
Route::get('user/list',['as'=>'user.list','middleware'=>['web'],'uses'=>'MuserController@listUser']);

Route::get('user/list',['as'=>'user.list','uses'=>'MuserController@listUser']);
Route::get('user/edit/{id}',['as'=>'user.edit','uses'=>'MuserController@edit']);
Route::post('user/edit',['as'=>'user.update','uses'=>'MuserController@update_user']);
Route::get('user/update_status/{user_id}/{user_status}',['as'=>'user.update_status','uses'=>'MuserController@udpateStatus']);
Route::get('user/delete/{id}',['as'=>'user.delete','uses'=>'MuserController@delete']);

Route::get('comapny/view/{id}',['as'=>'company.view','uses'=>'MuserController@show']);

Route::get('job/list',['as'=>'job.list','uses'=>'JobController@index']);
Route::get('job/post',['as'=>'job.post','uses'=>'JobController@create']);
Route::post('job/save',['as'=>'job.save','uses'=>'JobController@store']);
Route::get('job/edit/{id}',['as'=>'job.edit','uses'=>'JobController@edit']);
Route::post('job/update/{id}',['as'=>'job.update','uses'=>'JobController@update']);
Route::get('job/update_status/{job_id}/{job_status}',['as'=>'job.update_status','uses'=>'JobController@update_status']);
Route::get('job/detail/{id}',['as'=>'job.detail','uses'=>'JobController@show']);
Route::get('job/delete/{id}',['as'=>'job.delete','uses'=>'JobController@delete']);
Route::get('job/apply/{job_id}',['as'=>'job.apply','uses'=>'JobController@apply']);

Route::post('education/save',['as'=>'education.save','uses'=>'EmployeeController@store']);
Route::get('education/edit',['as'=>'education.edit','uses'=>'EmployeeController@edit']);
Route::post('education/udpate/{id}',['as'=>'education.update','uses'=>'EmployeeController@update']);
Route::get('education/delete/{id}',['as'=>'education.delete','uses'=>'EmployeeController@delete']);

Route::post('work-experience/save',['as'=>'work-experience.save','uses'=>'EmployeeController@saveWorkexperience']);
Route::get('work-experience/delete/{id}',['as'=>'work-experience.delete','uses'=>'EmployeeController@deleteWorkexperience']);
Route::get('work-experience/edit',['as'=>'work-experience.edit','uses'=>'EmployeeController@editWorkexperience']);
Route::post('work-experience/update/{id}',['as'=>'work-experience.update','uses'=>'EmployeeController@updateWorkexperience']);

Route::get('cv/list',['as'=>'cv.list','uses'=>'CvController@index']);
Route::get('pdffile','HomeController@generatepdf');