<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    //

    public function Category($category_product)
    {
        $category_pro = DB::select("SELECT * FROM tbl_product t, tbl_category_product c where t.category_id=$category_product AND t.category_id=c.category_id");
        return view('product.categoryproducts')->with('category_pro', $category_pro); //1

    }
}
