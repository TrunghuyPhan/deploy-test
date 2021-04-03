<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Product;
use Session;
class HomeController extends Controller
{
    public function Index(){
        $all_product = DB::table('tbl_product')->where('product_status','0')->orderby(DB::raw('RAND()'))->paginate(6); 
        return view('users.home')->with('all_product',$all_product); //1
    
    }
   /*Đăng nhập */
    public function dangnhap(Request $request){
        $dndt = $request->DNDT;
        $dnemail = $request->DNEMAIL;
        $dnmk = md5($request->DNMK); // mã hóa mật khẩu
        /* kiểm tra  số điện thoại và mật khẩu*/
            $dnkt = DB::select("SELECT * FROM tbl_customers WHERE customer_phone = ? OR customer_email = ? AND customer_password= ?",[$dndt,$dnemail,$dnmk]);
           
            if($dnkt){
                $makh = $dnkt[0]->customer_id;
                $sdt = $dnkt[0]->customer_phone;
                $name = $dnkt[0]->customer_name;
                $request->session()->put("id_customer", $makh); // tạo session tên makh
                $request->session()->put("phone_customer", $sdt); // tạo session tên sdt
                $request->session()->put("name_customer", $name);
                /* trả về ajax*/
                    return \response()->json(['kq'=>1,'customer_phone'=>$sdt,'customer_id'=>$makh,'name_customer'=>$name]);
            }
            else{
                /* trả về ajax*/
                    return \response()->json(['kq'=>0]);
            }

    }
    /* Đăng ký */
    public function dangky(Request $request){
        $email = $request->EMAIL;
        $sdt = $request->SDT;
        $mk = $request->MK;
        $name = $request->NAME;
      
     
        /* kiểm tra số điện thoại*/
            $kt = DB::select("SELECT * FROM tbl_customers WHERE customer_email = ? OR customer_phone = ? ",[$email,$sdt]);
            if(!$kt){
                /* thêm mới khách hàng*/
                $account = new Customer();
                $account["Customer_email"] = $email;
                $account["Customer_phone"] = $sdt;
                $account["Customer_password"] = md5($mk);
                $account["Customer_name"] = $name;
                $account->save();
                /* trả kết quả về ajax*/
                    return \response()->json(['kq'=>1]);
               
            }
            else{
                /* trả kết quả về ajax*/
                    return \response()->json(['kq'=>0]);
                }
            }
}
