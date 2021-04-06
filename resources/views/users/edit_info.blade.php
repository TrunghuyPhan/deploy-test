@extends('users.layout')
@section('content')
<?php $makh = Session::get('id_customer'); ?>
<div class="container">
    <h1>Chỉnh sua thong tin</h1>
    <div class="row">
        <div class="col-1"></div>
        <div class="col">
            <form>
                <!-- <div class="hienloi">
                    <div class="loi"></div>
                    <div class="loi2"></div>
                    <div class="loi3"></div>
                    <div class="loi4"></div>
                    <div class="loi5"></div>
                    <div class="loi6"></div>
                    <div class="capnhattc"></div>
                </div> -->
                @foreach($chinhsua as $info)
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label>Họ và Tên</label>
                        <input type="text" class="form-control ten" value="{{$info->customer_name}}">

                    </div>
                    <div class="form-group col-md-4">
                        <label>Email</label>
                        <input type="text" class="form-control email" value="{{$info->customer_email}}">
                    </div>
                    <div class="form-group col-4">
                        <label>Số điện thoại</label>
                        <input type="text" class="form-control sdt" value="{{$info->customer_phone}}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-4">
                        <label>Mật khẩu cũ</label>
                        <input type="Password" class="form-control oldmatkhau" placeholder="Nhập mật khẩu cũ">
                    </div>
                </div>
                <div class="form-row">

                    <div class="form-group col-5">
                        <label>Mật khẩu mới</label>
                        <input type="Password" class="form-control newmatkhau" placeholder="Mật khẩu mới">
                    </div>
                    <div class="form-group col-5">
                        <label>Nhập lại mật khẩu mới</label>
                        <input type="Password" class="form-control rematkhau" placeholder="Mật khẩu mới">
                    </div>


                </div>
                @endforeach

                <button type="submit" class="btn btn-primary chinhsua">Áp dụng</button>
            </form>
        </div>
        <div class="col-1"></div>
    </div>
</div>

@endsection

<script type="text/javascript">
    $(document).ready(function() {
        /* Xử lý đăng ký */
        $(".chinhsua").click(function() {
            var ten = $(".ten").val();
            var email = $(".email").val();
            var sdt = $(".sdt").val();
            var oldmatkhau = $(".oldmatkhau").val();
            var newmatkhau = $(".newmatkhau").val();
            var rematkhau = $(".rematkhau").val();
            var bieuthuc = /^(0[3578]|09)[0-9]{8}$/;
            var bieuthuc2 = /[a-zA-Z][^#&<>\"~;$^%{}?]{1,50}$/;
            var truyen = true;


            /*Kiểm tra điện thoại*/
            if (sdt != "") {
                if (sdt.search(bieuthuc) == -1) {
                    $(".loi").html("<div class='alert alert-danger'><strong>Số điện thoại bạn nhập không hợp lệ !</strong></div>");
                    truyen = false;
                } else {
                    $(".loi").html("");
                }
            }
            /*Kiểm tra mail*/
            atpos = email.indexOf("@");
            dotpos = email.lastIndexOf(".");
            //  var reg_mail = /^[A-Za-z0-9]+([_\.\-]?[A-Za-z0-9])*@[A-Za-z0-9]+([\.\-]?[A-Za-z0-9]+)*(\.[A-Za-z]+)+$/;
            if (atpos < 1 || (dotpos - atpos < 2)) {
                $(".loi7").html("<div class='alert alert-danger'><strong>Email khong hop le!</strong></div>");
                truyen = false;
            } else {
                $(".loi7").html("");
            }
            /*Kiểm tra tên*/
            if (ten.search(bieuthuc2) == -1) {
                $(".loi6").html("<div class='alert alert-danger'><strong>Tên bạn nhập không hợp lệ !</strong></div>");
                truyen = false;
            } else {
                $(".loi6").html("");
            }
            /*Kiểm tra mật khẩu */

            var xemmk = true;
            if (oldmatkhau == "") {
                // $(".loi2").html("<div class='alert alert-danger'><strong>Mật khẩu không được để trống !</strong></div>");
                alert("Lỗi");
                truyen = false;
                xemk = false;
            } else if (oldmatkhau.length > 30 || oldmatkhau.length < 6) {
                $(".loi2").html("<div class='alert alert-danger'><strong>Độ dài mật khẩu ít nhất 6 ký tự và  không quá 30 ký tự !</strong></div>");
                truyen = false;
                xemmk = false;
            } else {
                $(".loi2").html("");
            }
            /*Kiểm tra repassword*/
            if (newmatkhau == "") {
                // $(".loi3").html("<div class='alert alert-danger'><strong>Nhập lại mật khẩu không được để trống !</strong></div>");
                alert("Lỗi");
                truyen = false;
                xemmk = false;
            } else if (newmatkhau.length > 30 || newmatkhau.length < 6) {
                // $(".loi3").html("<div class='alert alert-danger'><strong>Nhập lại mật khẩu có độ dài không đúng!</strong></div>");
                alert("Lỗi");
                truyen = false;
                xemmk = false;
            } else {
                $(".loi3").html("");
            }
            /*Kiểm tra nhập lại mật khẩu đúng không*/
            if (xemmk == true && newmatkhau != oldmatkhau) {
                $(".loi4").html("<div class='alert alert-danger'><strong>Nhập lại mật khẩu không giống mật khẩu!</strong></div>");
                truyen = false;
            } else {
                $(".loi4").html("");
            }
            /*Kiểm tra xem đúng chưa để mở ajax truyền dữ liệu đi*/
            if (truyen == true) {
                $.ajax({
                    url: '{{URL::to(' / thongtin / .$makh ')}}',
                    type: 'POST',
                    data: {
                        _token: '{{csrf_token()}}',
                        MAKH: $makh,
                        CNTEN: ten,
                        CNSDT: sdt,
                        CNEMAIL: email,
                        OLDMK: oldmatkhau,
                        REMK: rematkhau,
                    },
                    success: function(data) {
                        if (data.kq == 0) {
                            $(".loi5").html("<div class='alert alert-danger'><strong>Xin lổi - Số điện thoại hoặc Email này đã đăng ký tài khoản trước đó !</strong></div>");
                        } else if (data.kq == 1) {
                            // $(".capnhattc").html("<div class='alert alert-success'><strong>Cập nhật thành công</strong></div>");
                            alert("Thành công");
                        }

                    }
                });
            }
        });
        /* Kết thúc xử lý đăng ký*/

    });
</script>