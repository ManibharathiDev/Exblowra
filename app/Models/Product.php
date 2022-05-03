<?php







namespace App\Models;



use Illuminate\Database\Eloquent\Model;







class Product extends Model



{   

    protected $table = 'tbl_product';

    public $timestamps = false;



    protected $fillable = [



        'pCode',

        'pName',

        'pRate',

        'pStatus',


    ];






}



