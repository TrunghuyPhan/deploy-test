<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;

use Illuminate\Support\Facades\Redirect;
use Cart;
use App\Coupon;
session_start();
class GioHangController extends Controller
{
    public function gio_hang(Request $request){
        //seo 
       $meta_desc = "Giỏ hàng của bạn"; 
       $meta_keywords = "Giỏ hàng Ajax";
       $meta_title = "Giỏ hàng Ajax";
       $url_canonical = $request->url();
       //--seo
       $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get(); 
       $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get(); 

       return view('cart.cart_ajax')->with('category',$cate_product)->with('brand',$brand_product)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical);
   }
   public function show_cart(Request $request){
    //seo 
    $meta_desc = "Giỏ hàng của bạn"; 
    $meta_keywords = "Giỏ hàng";
    $meta_title = "Giỏ hàng";
    $url_canonical = $request->url();
    //--seo
    $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get(); 
    $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get(); 
    return view('cart.show_cart')->with('category',$cate_product)->with('brand',$brand_product)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical);
}

public function update_cart_quantity(Request $request){
    $rowId = $request->rowId_cart;
    $qty = $request->cart_quantity;
    Cart::update($rowId,$qty);
    return Redirect::to('/show-cart');
}


   public function add_cart_ajax(Request $request){
       $data = $request->all();
       $session_id = substr(md5(microtime()),rand(0,26),5);
       $cart = Session::get('cart');
       if($cart==true){
           $is_avaiable = 0;
           foreach($cart as $key => $val){
               if($val['product_id']==$data['cart_product_id']){
                   $is_avaiable++;
               }
           }
           if($is_avaiable == 0){
               $cart[] = array(
               'session_id' => $session_id,
               'product_name' => $data['cart_product_name'],
               'product_slug'=>$data['cart_product_slug'],
               'product_id' => $data['cart_product_id'],
               'product_image' => $data['cart_product_image'],
               'product_qty' => $data['cart_product_qty'],
               'product_price' => $data['cart_product_price'],
               );
               Session::put('cart',$cart);
           }
       }else{
           $cart[] = array(
               'session_id' => $session_id,
               'product_name' => $data['cart_product_name'],
               'product_slug'=>$data['cart_product_slug'],
               'product_id' => $data['cart_product_id'],
               'product_image' => $data['cart_product_image'],
               'product_qty' => $data['cart_product_qty'],
               'product_price' => $data['cart_product_price'],

           );
           Session::put('cart',$cart);
       }
      
       Session::save();

   }



   public function save_cart(Request $request){
    $productId = $request->productid_hidden;
    $quantity = $request->qty;
    $product_info = DB::table('tbl_product')->where('product_id',$productId)->first(); 


    // Cart::add('293ad', 'Product 1', 1, 9.99, 550);
    // Cart::destroy();
    $data['id'] = $product_info->product_id;
    $data['qty'] = $quantity;
    $data['name'] = $product_info->product_name;
    $data['price'] = $product_info->product_price;
    $data['slug'] = $product_info->product_slug;
    $data['weight'] = $product_info->product_price;
    $data['options']['image'] = $product_info->product_image;
    Cart::add($data);
    return Redirect::to('/show-cart');
 
   
}   
public function delete_product($session_id){
    $cart = Session::get('cart');
    // echo '<pre>';
    // print_r($cart);
    // echo '</pre>';
    if($cart==true){
        foreach($cart as $key => $val){
            if($val['session_id']==$session_id){
                unset($cart[$key]);
            }
        }
        Session::put('cart',$cart);
        return redirect()->back()->with('message','Xóa sản phẩm thành công');

    }else{
        return redirect()->back()->with('message','Xóa sản phẩm thất bại');
    }

}
public function delete_to_cart($rowId){
    Cart::update($rowId,0);
    return Redirect::to('/show-cart');
}
public function delete_all_product(){
    $cart = Session::get('cart');
    if($cart==true){
        // Session::destroy();
        Session::forget('cart');
        Session::forget('coupon');
        return redirect()->back()->with('message','Xóa hết giỏ thành công');
    }
}
}
