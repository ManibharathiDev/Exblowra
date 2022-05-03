<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Redirect;
use Cookie;


class EmployeeController extends Controller
{
	public function employee(){

		return view('employee');
		//return view('login');
	}

	public function addemployee(){

        $nationality = DB::table('tbl_nationality')
        ->where('status',1)
        ->get();

        $empstatus = DB::table('tbl_emp_status')
        ->where('dStatus',1)
        ->get();



		return view('addemployee')->with(['nationality'=>$nationality,'empstatus'=>$empstatus]);
		//return view('login');
	}

    public function dublicateChecking(Request $request){
        $empNumber = $request->input('empNumber');
        $result = DB::table('tbl_employee')
        ->where('emp_no',$empNumber)
        ->first();
        $response = array();
        if($result === null){
            $response['success'] = 0;
            $response['message'] = "Emp Number does not exist";
        }
        else{
            $response['success'] = 1;
            $response['message'] = "Emp Number already exist";
        }
        echo json_encode($response);
    }

	public function save(Request $request){


		$employeeName = $request->input('employeeName');
    	$passportNumber = $request->input('passportNumber');
    	$passportExpiry = $request->input('passportExpiry');
        $passportExpiry = strtr($passportExpiry, '/', '-');
        $passportExpiry=date('Y-m-d',strtotime($passportExpiry));
        $idNumber = $request->input('idNumber');
        $idExpiry = $request->input('idExpiry');
        $idExpiry = strtr($idExpiry, '/', '-');
        $idExpiry=date('Y-m-d',strtotime($idExpiry));
        $entryDate = $request->input('entryDate');
        $entryDate = strtr($entryDate, '/', '-');
        $entryDate=date('Y-m-d',strtotime($entryDate));
        $nationality = $request->input('nationality');
        $phoneNumber = $request->input('phoneNumber');
        $homeNumber = $request->input('homeNumber');
        $camp = $request->input('camp');
        $empStatus = $request->input('empStatus');


         $empNumber = $request->input('empNumber');
        $result = DB::table('tbl_employee')
        ->where('emp_no',$empNumber)
        ->first();

        if($result != null){
            return redirect()->back()->with('Fail', 'Dublicate Entry, Employee number already exist');
        }


        $insert = DB::table('tbl_employee')->insertGetId(
                       [
                        'emp_no' =>$empNumber
                        ,'emp_name' => $employeeName
                        ,'passport_no' => $passportNumber
                        ,'id_no' => $idNumber
                        ,'first_entry_date' => $entryDate
                        ,'pass_expiry' => $passportExpiry
                        ,'id_expiry' => $idExpiry
                        ,'nationalityID' => $nationality
                        ,'phone_number' => $phoneNumber
                        ,'home_number' => $homeNumber
                        ,'camp' => $camp
                        ,'empStatus' => $empStatus
                    ]
                        );


        $result = DB::table('tbl_employee')
        ->where('emp_no',$empNumber)
        ->first();

        if($result != null)
        {
            
            if($empStatus== 2){
                $exitDate = $request->input('exitDate');
                $exit_date = strtr($exitDate, '/', '-');

                $exit_date=date('Y-m-d',strtotime($exit_date));
                DB::table('tbl_emp_exit_history')
                ->insert([
                    "emp_no" => $empNumber,
                    "exit_date" => $exit_date
                ]);
            }
            return redirect()->back()->with('success', 'Employee Created');
        }
        else{
            return redirect()->back()->with('Fail', 'Employee Not Created');
        }

        

        if($insert > 0){
        	return redirect()->back()->with('success', 'Employee Created');
        }
        else{
        	
        }

		
	}

	public function allemployee(Request $request)
	{
		$input = $request->all();
		$result = DB::table('tbl_employee')
        ->select('tbl_employee.*','tbl_nationality.*','tbl_emp_status.status as statusName','tbl_emp_status.id as statusid')
        ->join('tbl_nationality','tbl_employee.nationalityID','=','tbl_nationality.id')
        ->join('tbl_emp_status','tbl_employee.empStatus','=','tbl_emp_status.id')
        ->where('tbl_employee.status',1)
		->get();


        /*$nationality = DB::table('tbl_nationality')
        ->where('status',1)
        ->get();
*/
        $empstatus = DB::table('tbl_emp_status')
        ->where('dStatus',1)
        ->get();




        

		return View('employee')->with(['results'=>$result,'empstatus'=>$empstatus]);
	}

	public function edit_employee($emp_no)    
    {
        $result = DB::table('tbl_employee')
                    ->where('emp_no', $emp_no)
                    ->first();

                    $nationality = DB::table('tbl_nationality')
        ->where('status',1)
        ->get();

        $empstatus = DB::table('tbl_emp_status')
        ->where('dStatus',1)
        ->get();

        return View('editemployee')->with(['results'=>$result,'nationality'=>$nationality,'empstatus'=>$empstatus]);
    }

     public function employeeedit_save($emp_no , Request $request)    
    {
        $employeeName = $request->input('employeeName');
    	$passportNumber = $request->input('passportNumber');
    	$passportExpiry = $request->input('passportExpiry');
        $idNumber = $request->input('idNumber');
        $idExpiry = $request->input('idExpiry');
        $entryDate = $request->input('entryDate');
        $nationality = $request->input('nationality');
        $phoneNumber = $request->input('phoneNumber');
        $homeNumber = $request->input('homeNumber');
        $camp = $request->input('camp');
        $empStatus = $request->input('empStatus');

        $passportExpiry = strtr($passportExpiry, '/', '-');
        $passportExpiry=date('Y-m-d',strtotime($passportExpiry));

        $idExpiry = strtr($idExpiry, '/', '-');
        $idExpiry=date('Y-m-d',strtotime($idExpiry));

        $entryDate = strtr($entryDate, '/', '-');
        $entryDate=date('Y-m-d',strtotime($entryDate));
        

        $update = DB::table('tbl_employee')
				        ->where('emp_no',$emp_no)
				        ->update(
                       ['emp_name' => $employeeName
                        ,'passport_no' => $passportNumber
                        ,'id_no' => $idNumber
                        ,'first_entry_date' => $entryDate
                        ,'pass_expiry' => $passportExpiry
                        ,'id_expiry' => $idExpiry
                        ,'nationalityID' => $nationality
                        ,'phone_number' => $phoneNumber
                        ,'home_number' => $homeNumber
                        ,'camp' => $camp
                        ,'empStatus' => $empStatus
                    ]
                        );
                
        if($update)
        {
        	return redirect()->back()->with('success', "Employee Updated");
        }

        return redirect()->back()->with('Fail', 'Employee Not Updated');
        
    }

    public function delete_employee(Request $request){
        $input = $request->all();
        $result = DB::table('tbl_employee')
                    ->where('emp_no', $input['emp_no'])
                    ->update(['status' => 0]);
        return response()->json(['success'=>'Data is successfully added']);
    }

    public function viewemployee($emp_no){
        $result = DB::table('tbl_employee')
        ->join('tbl_nationality','tbl_employee.nationalityID','=','tbl_nationality.id')
        ->join('tbl_emp_status','tbl_employee.empStatus','=','tbl_emp_status.id')
        ->where('tbl_employee.emp_no',$emp_no)
        ->first();
        return View('viewemployee')->with('results',$result);
    }

    public function updatestatus(Request $request){
        $emp_no = $request->input('emp_no');
        $emp_status = $request->input('empStatus');
        $result = DB::table('tbl_employee')
        ->where('emp_no',$emp_no)
        ->update([
            "empStatus"=>$emp_status
        ]);

        if($emp_status== 2)
        {
                $exitDate = $request->input('exitDate');
                $exit_date = strtr($exitDate, '/', '-');

                $exit_date=date('Y-m-d',strtotime($exit_date));
                DB::table('tbl_emp_exit_history')
                ->insert([
                    "emp_no" => $emp_no,
                    "exit_date" => $exit_date
                ]);
                $result = DB::table('tbl_employee')
                ->where('emp_no',$emp_no)
                ->update([
                    "last_exit_date"=>$exit_date
                ]);
            }
            return redirect()->back()->with('success', "Employee status updated");
    }
}