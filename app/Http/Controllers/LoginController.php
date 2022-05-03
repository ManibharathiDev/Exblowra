<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Crypt;
use Redirect;
use Cookie;


class LoginController extends Controller
{

	public function index(){

		return view('login',['password'=>Cookie::get('user_password')]);
		//return view('login');
	}

	public function logincheck(Request $request)
	{
		$result = DB::table('tbl_user')
		->where('login_id',$request->input('loginUsername'))
		->first();

			if($result === null)
			{
						return redirect()->back()->with('Fail', 'Invalid Crdentials');
			}
			else{
						
						
					$currentPassword = Crypt::decrypt($result->password);
					
						if($currentPassword	== $request->input('loginPassword'))
						{
							Session::put('user_name',  $result->username);
							Session::put('user_type',  $result->user_type);
							/*$role = DB::table('tbl_role')
							->where('uid',$result->uid)
							->first();*/
							/*if($role !== null){
								Session::put('billing',  $role->billing);
								Session::put('customer',  $role->customer);
								Session::put('topup',  $role->topup);
								Session::put('purchase',  $role->purchase);
								Session::put('product',  $role->product);
								Session::put('report',  $role->report);

								Session::put('user',  $role->user);
							}*/

							if($request->input('remember') !== null)
							{
								Cookie::queue("user_password", $request->input('password'), 6000000);
							}
							else{
								Cookie::queue("user_password", "", 6000000);
							}

							return Redirect::to('/dashboard');
							
						
						}
						else
							return redirect()->back()->with('Fail', 'Invalid Crdentials');
			}

		
		echo json_encode($response);
	}

	public function logout()
	{
		session()->flush();
        //return redirect()->action('LoginController@index');
			return Redirect::to('/login');
        //return redirect()->action([LoginController::class, 'index']);
	}
}