<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function AllProduct()
    {
        $all_product = DB::table('tbl_product')->paginate(6);
        return view('product.products')->with('all_product', $all_product); //1
    }
    public function Search()
    {
        $all_product = DB::table('tbl_product')->get('*');
        return view('product.search_result')->with('all_product', $all_product); //1


    }
    public function DetailsProduct($product_slug, Request $request)
    {
        $cate_product = DB::table('tbl_category_product')->where('category_status', '0')->orderby('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status', '0')->orderby('brand_id', 'desc')->get();
        $all_product = DB::table('tbl_product')->paginate(5);
        // $comment ="SELECT * FROM tbl_comment t, tbl_product p WHERE t.comment_product_id=p.product_id AND p.product_slug='$product_slug'";
        $comment = DB::table('tbl_comment')
            ->join('tbl_product', 'tbl_product.product_id', '=', 'tbl_comment.comment_product_id')
            ->where('tbl_product.product_slug', $product_slug)->get();
        $details_product = DB::table('tbl_product')
            ->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
            ->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')
            ->where('tbl_product.product_slug', $product_slug)->get();
        foreach ($details_product as $key => $value) {
            $category_id = $value->category_id;
        }

        return view('product.details')->with('category', $cate_product)->with('brand', $brand_product)->with('product_details', $details_product)->with('all_product', $all_product)->with('comment', $comment);
    }
}
