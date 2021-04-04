<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public $timestamps = false; //set time to false
    protected $primaryKey = 'customer_id';
 	protected $table = 'tbl_customers';
 	
}
