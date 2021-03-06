<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class ProductController extends Controller
{
    public function AllProduct()
    {
        $all_product = DB::table('tbl_product')->paginate(9);
        return view('product.products')->with('all_product', $all_product); //1
    }
    public function Search()
    {
        $all_product = DB::table('tbl_product')->get('*');
        return view('product.search_result')->with('all_product', $all_product); //1


    }
    public function DetailsProduct($product_slug, Request $request)
    {
        $cate_product = DB::table('tbl_category_product')->orderby('category_id', 'desc')->get();

        $all_product = DB::table('tbl_product')->paginate(5);
        // $comment ="SELECT * FROM tbl_comment t, tbl_product p WHERE t.comment_product_id=p.product_id AND p.product_slug='$product_slug'";
        $comment = DB::table('tbl_comment')
            ->join('tbl_product', 'tbl_product.product_id', '=', 'tbl_comment.comment_product_id')
            ->where('tbl_product.product_slug', $product_slug)->get();
        $details_product = DB::table('tbl_product')
            ->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')

            ->where('tbl_product.product_slug', $product_slug)->get();
        foreach ($details_product as $key => $value) {
            $category_id = $value->category_id;
        }

        return view('product.details')->with('category', $cate_product)->with('product_details', $details_product)->with('all_product', $all_product)->with('comment', $comment);
    }
    public function edit_product($product_id)
    {
        //bat dieu kien dang nhap 
        $cate_product = DB::table('tbl_category_product')->get();


        $edit_product = DB::table('tbl_product')->where('product_id', $product_id)->get();

        $manager_product  = view('admin.edit_product')->with('edit_product', $edit_product)->with('cate_product', $cate_product);

        return view('admin.admin_layout')->with('admin.edit_product', $manager_product);
    }
    public function update_product(Request $request, $product_id)
    {

        $data = array();
        $data['product_name'] = $request->product_name;

        $data['product_slug'] = $request->product_slug;
        $data['product_price'] = $request->product_price;
        $data['product_desc'] = $request->product_desc;

        $data['category_id'] = $request->product_cate;
        // $data['product_image'] = $request->product_image;
        $get_image = $request->product_image;

        if ($get_image) {
            $data['product_image'] = $request->product_image;
            DB::table('tbl_product')->where('product_id', $product_id)->update($data);
            Session::put('message', 'C???p nh???t s???n ph???m th??nh c??ng');
            return Redirect::to('admin/index');
        }

        DB::table('tbl_product')->where('product_id', $product_id)->update($data);
        Session::put('message', 'C???p nh???t s???n ph???m th??nh c??ng');
        return Redirect::to('admin/index');
    }
    public function add_product()
    {

        $cate_product = DB::table('tbl_category_product')->get();



        return view('admin.add_product')->with('cate_product', $cate_product);
    }
    public function save_product(Request $request)
    {

        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_slug'] = $request->product_slug;
        $data['product_price'] = $request->product_price;
        $data['product_desc'] = $request->product_desc;

        $data['category_id'] = $request->product_cate;

        $data['product_image'] = $request->product_image;
        $get_image = $request->product_image;


        if ($get_image) {

            $data['product_image'] =  $request->product_image;
            DB::table('tbl_product')->insert($data);
            Session::put('message', 'Th??m s???n ph???m th??nh c??ng');
            return Redirect::to('admin/index');
        }
        $data['product_image'] = '';
        DB::table('tbl_product')->insert($data);
        Session::put('message', 'Th??m s???n ph???m th??nh c??ng');
        return Redirect::to('admin/index');
    }
    public function delete_product($product_id)
    {

        DB::table('tbl_product')->where('product_id', $product_id)->delete();
        Session::put('message', 'X??a s???n ph???m th??nh c??ng');
        return Redirect::to('admin/index');
    }
}
