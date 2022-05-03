<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/index','LoginController@index');

/*Route::get('/', function () {
    return view('login');
});*/

Route::get('/invalid','UserController@unauthorized');

Route::get('/login','LoginController@index');
Route::post('/logincheck','LoginController@logincheck');
Route::get('/logout','LoginController@logout');


Route::get('/setup','SetupController@setup');

Route::post('/setupdb','SetupController@setupdb');

Route::get('/dashboard','DashboardController@dashboard');

// Employee

Route::get('employee','EmployeeController@allemployee');
Route::get('addemployee','EmployeeController@addemployee');
Route::post('saveemployee','EmployeeController@save');
Route::get('/editemployee/{emp_no}', 'EmployeeController@edit_employee');
Route::post('/editemployee/{emp_no}/save', 'EmployeeController@employeeedit_save');
Route::post('dublicateChecking','EmployeeController@dublicateChecking');
Route::post('/delete_employee','EmployeeController@delete_employee');
Route::get('/viewemployee/{emp_no}', 'EmployeeController@viewemployee');
Route::post('updatestatus','EmployeeController@updatestatus');

Route::get('project','ProjectController@allproject');
Route::get('addproject','ProjectController@addproject');
Route::post('saveproject','ProjectController@save');
Route::get('/editproject/{project_no}', 'ProjectController@edit_project');
Route::post('/editproject/{project_no}/save', 'ProjectController@projectedit_save');
Route::post('/delete_project','ProjectController@delete_project');
Route::get('/viewproject/{project_no}', 'ProjectController@viewproject');

Route::get('client','ClientController@allclient');
Route::get('addclient','ClientController@addclient');
Route::post('saveclient','ClientController@save');
Route::get('/editclient/{client_no}', 'ClientController@edit_client');
Route::post('/editclient/{client_no}/save', 'ClientController@clientedit_save');
Route::post('/delete_client','ClientController@delete_client');

Route::get('job','JobController@alljob');
Route::get('addjob','JobController@addjob');
Route::post('savejob','JobController@save');
Route::post('/delete_job','JobController@delete_job');
Route::get('/editjob/{job_no}', 'JobController@edit_job');
Route::post('/editjob/{client_no}/save', 'JobController@jobedit_save');

Route::get('timesheet','TimesheetController@timesheet');
Route::any('/addtimesheet/{emp_no}', 'TimesheetController@addtimesheet');
Route::post('/getjobbyproject','TimesheetController@getjobbyproject');
Route::post('/savetimesheet/{emp_no}','TimesheetController@savetimesheet');


Route::get('user','UserController@alluser');
Route::get('adduser','UserController@adduser');
Route::post('saveuser','UserController@save');
Route::post('delete_user','UserController@delete_user');
Route::get('/edituser/{user_no}','UserController@edit_user');
Route::post('/edituser/{user_no}/save','UserController@useredit_save');







