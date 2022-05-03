<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Crypt;
use Redirect;



class UserController extends Controller
{
	public function alluser(){
		$result = DB::table('tbl_user')
		->get();
		return View('user')->with('results',$result);
	}

	public function adduser(){
		return View('adduser');
	}

	public function save(Request $request)
	{

		$check = DB::table('tbl_user')
		->where('login_id',$request->input('loginID'))
		->first();

		//return redirect()->back()->with('Fail', $check);

		if($check === null)
		{
			if($request->input('password') != $request->input('cPassword')){
				return redirect()->back()->with('Fail', 'Password doesnot match');
			}
		$result = DB::table('tbl_user')
		->insert([
			'user_type'=>$request->input('userType')
			,'username'=>$request->input('userName')
			,'login_id'=>$request->input('loginID')
			,'password'=>Crypt::encrypt($request->input('password'))
		]);
		if($result){
        	return redirect()->back()->with('success', 'User Created');
        }
        else{
        	return redirect()->back()->with('Fail', 'User Unable to Create');
        }
        }
        else{
        	return redirect()->back()->with('Fail', 'Login ID already exist, Please try with different login id');
        }

	}

	public function delete_user(Request $request){
		$input = $request->all();
        /*$result = DB::table('tbl_user')
                    ->where('uid', $input['user_no'])
                    ->update(['dStatus' => 0]);*/
        $result = DB::table('tbl_user')
                    ->where('uid', $input['user_no'])
                    ->delete();
        return response()->json(['success'=>'Data is successfully added']);
	}

	public function edit_user($user_no){
			$result = DB::table('tbl_user')
                    ->where('uid', $user_no)
                    ->first();
        
 
        return View('edituser')->with('results',$result);
	}

	public function useredit_save($user_no, Request $request){
		$check = DB::table('tbl_user')
		->where('login_id',$request->input('loginID'))
		->where('uid','!=',$user_no)
		->first();
		if($check === null){
			$result = DB::table('tbl_user')
			->where('uid',$user_no)
		->update([
			'user_type'=>$request->input('userType')
			,'username'=>$request->input('userName')
			,'login_id'=>$request->input('loginID')
			,'password'=>Crypt::encrypt($request->input('password'))
		]);
			if($result){
        	return redirect()->back()->with('success', 'User Updated');
        }
        else{
        	return redirect()->back()->with('Fail', 'User Unable to Update');
        }
		}
		else{
			return redirect()->back()->with('Fail', 'Login ID already exist, Please try with different login id');
		}
	}

}