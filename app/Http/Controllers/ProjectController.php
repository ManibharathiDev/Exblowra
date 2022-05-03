<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Redirect;
use Cookie;


class ProjectController extends Controller
{
	public function project(){

		return view('project');
		//return view('login');
	}
	public function addproject()
	{

		$result = DB::table('tbl_client')
		->get();
        $jobresult = DB::table('tb_job')
        ->where('dStatus',1)
        ->get();
		return view('addproject')->with(['results'=>$result,'jobResult'=>$jobresult]);

	}

	public function save(Request $request){


		$projectName = $request->input('projectName');
    	$clientName = $request->input('clientName');
    	$contactPerson = $request->input('contactPerson');
        $location = $request->input('location');
        $phoneNumber = $request->input('phoneNumber');
        $normalHours = $request->input('normalHours');

        $insert = DB::table('tbl_project')->insertGetId(
                       ['project_name' => $projectName
                        ,'client_id' => $clientName
                        ,'contact_person' => $contactPerson
                        ,'location' => $location
                        ,'phone_number' => $phoneNumber
                        ,'normal_hours' => $normalHours
                    ]
                        );
        if($insert)
        {
            $job = $request->input('job');
           /* $price = $request->input('price');*/
            $sdate = $request->input('sdate');

            $nhour = $request->input('nhour');
            $ot = $request->input('ot');
            $hot = $request->input('hot');
            $jobInsert[] = array();
            foreach($job as $index => $value)
            {

                $startDate = strtr($sdate[$index], '/', '-');
                $startDate=date('Y-m-d',strtotime($startDate));

                    DB::table('tbl_project_price')->insert( [
                        'project_id' => $insert
                        ,'job_id' => $job[$index]
                        ,'start_date' => $startDate
                        ,'price_ot' => $ot[$index]
                        ,'price_nt' => $nhour[$index]
                        ,'price_hot'=> $hot[$index]
                    ]);
            }
            
        	return redirect()->back()->with('success', 'Project Created');
        }
        else{
        	return redirect()->back()->with('Fail', 'Project unable to create');
        }

		//return redirect()->back()->with('success', 'Employee Created'); 

		
		//return view('addemployee');
		//return view('login');
	}

	public function allproject(Request $request)
	{
		$input = $request->all();
		$result = DB::table('tbl_project')
			->select('tbl_project.*','tbl_client.client_id as client_id','tbl_client.client_name as client_name')
		->join('tbl_client','tbl_project.client_id','=','tbl_client.client_id')
        ->where('tbl_project.dStatus',1)
		->get();
		return View('project')->with('results',$result);
	}

	public function edit_project($project_no)    
    {
        $presult = DB::table('tbl_project')
                    ->where('project_id', $project_no)
                    ->first();

        $clientResult = DB::table('tbl_client')
        		->get();

        $jobresult = DB::table('tb_job')
        ->get();

        $jobpriceresult = DB::table('tbl_project_price')
        ->where('project_id',$project_no)
        ->get();
        
 		return view('editproject')->with(['projectresult'=>$presult,
            'clientResult'=>$clientResult,
             'projectpriceresult' => $jobpriceresult,
             'jobresult' => $jobresult   
        ]);
        
    }

     public function projectedit_save($project_no , Request $request)    
    {
        $projectName = $request->input('projectName');
    	$clientName = $request->input('clientName');
    	$contactPerson = $request->input('contactPerson');
        $location = $request->input('location');
        $phoneNumber = $request->input('phoneNumber');
        $normalHours = $request->input('normalHours');
        

        $update = DB::table('tbl_project')
				        ->where('project_id',$project_no)
				        ->update(
                       ['project_name' => $projectName
                        ,'client_id' => $clientName
                        ,'contact_person' => $contactPerson
                        ,'location' => $location
                        ,'phone_number' => $phoneNumber
                        ,'normal_hours' => $normalHours
                    ]
                        );
                
        if($update)
        {
            DB::table('tbl_project_price')
            ->where('project_id',$project_no)
            ->delete();

            $job = $request->input('job');
            /*$price = $request->input('price');*/
            $sdate = $request->input('sdate');
            $nhour = $request->input('nhour');
            $ot = $request->input('ot');
            $hot = $request->input('hot');
            $jobInsert[] = array();
            foreach($job as $index => $value)
            {

                $startDate = strtr($sdate[$index], '/', '-');
                $startDate=date('Y-m-d',strtotime($startDate));

                    DB::table('tbl_project_price')->insert( [
                        'project_id' => $project_no
                        ,'job_id' => $job[$index]
                        ,'start_date' => $startDate
                        ,'price_ot' => $ot[$index]
                        ,'price_nt' => $nhour[$index]
                        ,'price_hot'=> $hot[$index]
                    ]);
            }
        	return redirect()->back()->with('success', "Project Updated");
        }
        else{
            DB::table('tbl_project_price')
            ->where('project_id',$project_no)
            ->delete();

            $job = $request->input('job');
            $sdate = $request->input('sdate');
            $nhour = $request->input('nhour');
            $ot = $request->input('ot');
            $hot = $request->input('hot');
            $jobInsert[] = array();
            $flag = 0;
            foreach($job as $index => $value)
            {

                $startDate = strtr($sdate[$index], '/', '-');
                $startDate=date('Y-m-d',strtotime($startDate));
                    DB::table('tbl_project_price')->insert( [
                        'project_id' => $project_no
                        ,'job_id' => $job[$index]
                        ,'start_date' => $startDate
                        ,'price_ot' => $ot[$index]
                        ,'price_nt' => $nhour[$index]
                        ,'price_hot'=> $hot[$index]
                    ]);
                    $flag = 1;
            }
            if($flag == 1){
                return redirect()->back()->with('success', "Project Updated");
            }
            return redirect()->back()->with('Fail', 'Project unable to update');
        }

        return redirect()->back()->with('Fail', 'Project unable to update');
        
    }

    public function delete_project(Request $request){
        $input = $request->all();
        $result = DB::table('tbl_project')
                    ->where('project_id', $input['project_no'])
                    ->update(['dStatus' => 0]);
        return response()->json(['success'=>'Data is successfully added']);
    }

    public function viewproject($project_no){
        $projectresult = DB::table('tbl_project')
            ->select('tbl_project.*','tbl_client.client_id as client_id','tbl_client.client_name as client_name')
        ->join('tbl_client','tbl_project.client_id','=','tbl_client.client_id')
        ->where('tbl_project.dStatus',1)
        ->where('tbl_project.project_id',$project_no)
        ->first();

        $projectpriceresult = DB::table('tbl_project_price')
        ->join('tb_job','tbl_project_price.job_id','=','tb_job.job_id')
        ->where('tbl_project_price.project_id',$project_no)
        ->get();

        return view('viewproject')->with(['projectresult'=>$projectresult,
             'projectpriceresult' => $projectpriceresult 
        ]);


    }
}