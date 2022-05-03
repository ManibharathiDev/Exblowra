<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Redirect;
use Cookie;


class JobController extends Controller
{
	public function job(){

		return view('job');
		//return view('login');
	}
	public function addjob(){

		return view('addjob');
		//return view('login');
	}
	public function save(Request $request)
	{
		$job = $request->input('jobName');
		$jobs = explode(",",$job);

		$insert[] = array();
		
		foreach($jobs as $index => $value)
		{
			$result = DB::table('tb_job')
			->where('job_name',$jobs[$index])
			->first();
			if($result === null)
				{
					$insert[] = [
                        'job_name' => $jobs[$index]
                    ];
				}	
			 
		}

		foreach ($insert as $t) 
		{
            $insertData = DB::table('tb_job')->insert($t);
        }
        if($insertData){
        	return redirect()->back()->with('success', 'Job Added');
        }
        else{
        	return redirect()->back()->with('Fail', 'Job Unable to Add');
        }

	}

	public function alljob(Request $request)
	{
		$input = $request->all();
		$result = DB::table('tb_job')
        ->where('dStatus',1)
		->get();
		return View('job')->with('results',$result);
	}

	public function delete_job(Request $request){
		$input = $request->all();
        $result = DB::table('tb_job')
                    ->where('job_id', $input['job_no'])
                    ->update(['dStatus' => 0]);
        return response()->json(['success'=>'Data is successfully added']);
	}

	public function edit_job($job_no)    
    {
        $result = DB::table('tb_job')
                    ->where('job_id', $job_no)
                    ->first();
        
 
        return View('editjob')->with('results',$result);
    }

     public function jobedit_save($job_no , Request $request)    
    {
        $jobName = $request->input('jobName');
    	

        $update = DB::table('tb_job')
				        ->where('job_id',$job_no)
				        ->update(
                       ['job_name' => $jobName
                       
                    ]
                        );
                
        if($update)
        {
        	return redirect()->back()->with('success', "Job Updated");
        }

        return redirect()->back()->with('Fail', 'Job unable to update');
        
    }
}