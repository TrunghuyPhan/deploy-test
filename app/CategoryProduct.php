<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryProduct extends Model
{
    //
    public $timestamps = false;
    protected $table = "tbl_category_product";
    protected $primaryKey = "category_id";
}
