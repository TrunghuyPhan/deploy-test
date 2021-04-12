<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class AdminController extends Controller
{
    public function index()
    {
        $all_product = DB::table('tbl_product')
            ->join('tbl_category_product', 'tbl_product.category_id', '=', 'tbl_category_product.category_id')
            ->paginate(10);

        return view('admin.admin_index')->with('all_product', $all_product);
    }
    public function GLogin()
    {
        return view('admin.admin_login');
        // return view('admin.admin_login');
    }
    public function PLogin(Request $request)
    {
        $ten = $request->TEN;
        $matkhau = md5($request->MK); // mã hóa mật khẩu
        /* kiểm tra  số điện thoại và mật khẩu*/
        $dnkt = DB::select("SELECT * FROM tbl_admin WHERE admin_email = ?  AND admin_password = ? ", [$ten, $matkhau]);
        if ($dnkt) {
            $maADMIN = $dnkt[0]->admin_id;
            $name = $dnkt[0]->admin_name;
            $image = $dnkt[0]->admin_image;
            $request->session()->put("id_admin", $maADMIN); // tạo session tên makh
            $request->session()->put("name_admin", $name);
            $request->session()->put("image_admin", $image);
            /* trả về ajax*/

            return \response()->json(['kq' => 1,  'id_admin' =>  $maADMIN, 'name_admin' => $name, 'image_admin' => $image]);
        } else {
            /* trả về ajax*/

            return \response()->json(['kq' => 0]);
        }
    }
}
