<?php







namespace App\Models;



use Illuminate\Database\Eloquent\Model;







class Customer extends Model



{   

    protected $table = 'tbl_customer';

    public $timestamps = false;



    protected $fillable = [



        'cNumber',

        'cName',

        'cStatus',

        'cDStatus',

        'balance',

    ];






}



