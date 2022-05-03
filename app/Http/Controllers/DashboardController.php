<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Redirect;
use Cookie;


class DashboardController extends Controller
{
	public function dashboard(){

		return view('dashboard');
		//return view('login');
	}
}