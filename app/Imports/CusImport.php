<?php

namespace App\Imports;

use App\Models\Customer;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use DB;

class CusImport implements ToCollection,WithHeadingRow
{
    
    public function headingRow(): int
    {
        return 1;
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) 
        {

          $result = DB::table('tbl_customer')->where('cNumber',$row['code']);
          if($result->count() == 0)
          {
            Customer::create([
                'cNumber' => $row['code'],
                 'cName'  => $row['customer_name'],
                 'cStatus' =>1,
                 'cDStatus' =>1,
                 'balance' => $row['balance'],
            ]);
          }
            
        }
    }

    
}