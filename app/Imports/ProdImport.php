<?php

namespace App\Imports;

use App\Models\Product;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use DB;

class ProdImport implements ToCollection,WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return User|null
     */
    /*public function model(array $row)
    {
        return new Customer([
           'cNumber'     => $row[0],
           'cName'    => $row[1],
           'cStatus' =>1,
           'balance' => $row[2],
        ]);
    }
*/

   public function headingRow(): int
    {
        return 1;
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) 
        {

          /*$result = DB::table('tbl_product')->where('cNumber',$row[0]);
          if($result->count() == 0)
          {*/
            Product::create([
                'pCode'     => $row['billing_code'],
                 'pName'    => $row['product'],
                 'pStatus' => 1,
                 'pRate' => $row['rate'],
            ]);
          /*}*/
            
        }
    }
}