<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Redirect;
use Cookie;


class ClientController extends Controller
{
  public function client(){

    return view('client');
    //return view('login');
  }

  public function addclient(){

    return view('addclient');
    //return view('login');
  }

  public function save(Request $request){


		$clientName = $request->input('clientName');
    	$contactPerson = $request->input('contactPerson');
    	$address = $request->input('address');
        $phoneNumber = $request->input('phoneNumber');

        $insert = DB::table('tbl_client')->insertGetId(
                       ['client_name' => $clientName
                        ,'contact_person' => $contactPerson
                        ,'address' => $address
                        ,'phone_number' => $phoneNumber
                    ]
                        );
        if($insert){
        	return redirect()->back()->with('success', 'Client Created');
        }
        else{
        	return redirect()->back()->with('Fail', 'Client Unable to Create');
        }

		//return redirect()->back()->with('success', 'Employee Created'); 

		
		//return view('addemployee');
		//return view('login');
	}

	public function allclient(Request $request)
	{
		$input = $request->all();
		$result = DB::table('tbl_client')
		->where('dStatus',1)
		->get();
		return View('client')->with('results',$result);
	}

	public function edit_client($client_no)    
    {
        $result = DB::table('tbl_client')
                    ->where('client_id', $client_no)
                    ->first();
        
 
        return View('editclient')->with('results',$result);
    }

     public function clientedit_save($client_no , Request $request)    
    {
        $clientName = $request->input('clientName');
    	$contactPerson = $request->input('contactPerson');
    	$address = $request->input('address');
        $phoneNumber = $request->input('phoneNumber');
        

        $update = DB::table('tbl_client')
				        ->where('client_id',$client_no)
				        ->update(
                       ['client_name' => $clientName
                        ,'contact_person' => $contactPerson
                        ,'address' => $address
                        ,'phone_number' => $phoneNumber
                    ]
                        );
                
        if($update)
        {
        	return redirect()->back()->with('success', "Client Updated");
        }

        return redirect()->back()->with('Fail', 'Client unable to update');
        
    }

    public function delete_client(Request $request){
        $input = $request->all();
        $result = DB::table('tbl_client')
                    ->where('client_id', $input['client_no'])
                    ->update(['dStatus' => 0]);
        return response()->json(['success'=>'Data is successfully added']);
    }
}