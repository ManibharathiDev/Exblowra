<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Redirect;
use Cookie;


class TimesheetController extends Controller
{
	public function timesheet(){

		return view('timesheet');
		//return view('login');
	}

	public function addtimesheet($emp_no, Request $request)
	{
		$result = DB::table('tbl_employee')
		->where('emp_no',$emp_no)
		->first();
		$date = $request->input('timeSheetDate');
		$projectresult = DB::table('tbl_project')
		->where('isActive',1)
		->where('dStatus',1)
		->get();

		

			if($request->has('timeSheetDate') && !empty($request->input('timeSheetDate'))) 
			{
			$month = explode("/",$date);
			$timeresult = DB::table('tbl_timesheet')
			->where('emp_no',$emp_no)
			->whereMonth('date', $month[1])
			->get();
			}
			else
			{
				$month = date('m');
				$timeresult = DB::table('tbl_timesheet')
			->where('emp_no',$emp_no)
			->whereMonth('date', $month)
			->get();
			
			}

	$skillResult = DB::table('tbl_project_price')
	->join('tb_job','tbl_project_price.job_id','=',"tb_job.job_id")
	->get();

		/*return redirect()->back()->with(['results'=>$result,'date'=>$date]);*/

		return View('timesheet')->with(['results'=>$result,'date'=>$date,'projectresult'=>$projectresult,'timeresult'=>$timeresult,'skillresult'=>$skillResult]);

	}

	public function getjobbyproject(Request $request){
		
		$result = DB::table('tbl_project_price')
		->join('tb_job','tbl_project_price.job_id','=','tb_job.job_id')
		->where('tbl_project_price.project_id',$request->input('projectid'))
		->get();
		$response = array();
		if(count($result) > 0){
			$response['success'] = 1;
			$response['data'] = $result;
		}
		else{
			$response['success'] = 0;
		}
		echo json_encode($response);
	}

	public function savetimesheet($empno,Request $request)
	{

		    $input = $request->all();
			$date = $input['date'];
			$project = $input['project'];
			$skill = $input['skill'];
			$nhours = $input['nhours'];
			$othours = $input['othours'];
			$emp_no = $empno;
			$insert = array();

			
			foreach($project as $index => $value)
			{
				if($project[$index] != "" && $skill[$index] != "" && $nhours[$index] != "" && $othours[$index] != "")
				{
					array_push($insert, [
						'emp_no' => $emp_no
						,'project_id' => $project[$index]
						,'date' => $date[$index]
						,'job_id' => $skill[$index]
						,'normal_time' => $nhours[$index]
						,'over_time' => $othours[$index]
						,'hover_time' => $othours[$index]
				]);

				} 
				/*DB::table('tbl_timesheet')
					->where('emp_no',$emp_no)
					->where('project_id',$project[$index])
					->where('job_id',$skill[$index])
					->where('date',$date[$index])
					->delete();*/

					DB::table('tbl_timesheet')
					->where('emp_no',$emp_no)
					->where('date',$date[$index])
					->delete();
			}

			if(!empty($insert))
			{

				foreach ($insert as $t) 
					{
            		$insertData = DB::table('tbl_timesheet')->insert($t);
       				}

       				if($insertData){
       					return redirect()->back()->with('success', 'Timesheet Added to given Employee');
       				}
       				else{
       					return redirect()->back()->with('Fail', 'Timesheet unable to add given Employee');
       				}
			}
			else{
				return redirect()->back()->with('Fail', 'Empty Data');
			}
			

	}
}