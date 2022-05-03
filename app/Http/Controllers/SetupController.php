<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Redirect;
use Cookie;
use Schema;
use Artisan;


class SetupController extends Controller
{
		public function setup()
		{
				return view('setup');
		//return view('login');
		}

		public function setupDB(Request $request)
		{
			$db_name = $request->input('dbName');
			$db_pass = $request->input('dbPassword');
			$db_user = $request->input('dbUserName');
			$env_update = $this->changeEnv([
            'DB_DATABASE'   => $db_name,
            'DB_USERNAME'   => $db_user,
            'DB_PASSWORD'   => $db_pass,
            'DB_HOST'       => '127.0.0.1'
        ]);
			$response = array();
			if($env_update){

				DB::statement('create database ' .$db_name );

				Artisan::call('cache:clear');
				Artisan::call('view:clear');
				Artisan::call('route:clear');
				Artisan::call('config:clear');

        				Schema::create('testTable', function($table)
						{           
		    				$table->increments('id');
						});
						$response['success'] = 1;
        		} else {
            		$response['success'] = 0;
       		 }
       		 echo json_encode($response);
		}

		protected function changeEnv($data = array()){
        if(count($data) > 0){

            // Read .env-file
            $env = file_get_contents(base_path() . '/.env');

            // Split string on every " " and write into array
            $env = preg_split('/\s+/', $env);;

            // Loop through given data
            foreach((array)$data as $key => $value){

                // Loop through .env-data
                foreach($env as $env_key => $env_value){

                    // Turn the value into an array and stop after the first split
                    // So it's not possible to split e.g. the App-Key by accident
                    $entry = explode("=", $env_value, 2);

                    // Check, if new key fits the actual .env-key
                    if($entry[0] == $key){
                        // If yes, overwrite it with the new one
                        $env[$env_key] = $key . "=" . $value;
                    } else {
                        // If not, keep the old one
                        $env[$env_key] = $env_value;
                    }
                }
            }

            // Turn the array back to an String
            $env = implode("\n", $env);

            // And overwrite the .env with the new data
            file_put_contents(base_path() . '/.env', $env);
            
            return true;
        } else {
            return false;
        }
    }

		private function setEnv($key, $value)
		{
	file_put_contents(app()->environmentFilePath(), str_replace(
		$key . '=' . env($value),
		$key . '=' . $value,
		file_get_contents(app()->environmentFilePath())
	));
		}
}