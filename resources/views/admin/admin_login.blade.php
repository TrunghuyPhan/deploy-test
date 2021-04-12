<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>



<div class="login-page">
    <div class="form">
        <div class="loi">
            <div class="dnloi3"></div>
            <div class="dntc"></div>
        </div>

        <div class="dnloi"></div>
        <input type="text" class="ten" placeholder="username" />
        <div class="dnloi2"></div>
        <input type="password" class="matkhau" placeholder="password" />
        <button class="dangnhap">login</button>


    </div>
</div>

<style>
    @import url(https://fonts.googleapis.com/css?family=Roboto:300);

    .login-page {
        width: 360px;
        padding: 8% 0 0;
        margin: auto;
    }

    .form {
        position: relative;
        z-index: 1;
        background: #FFFFFF;
        max-width: 360px;
        margin: 0 auto 100px;
        padding: 45px;
        text-align: center;
        box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
    }

    .form input {
        font-family: "Roboto", sans-serif;
        outline: 0;
        background: #f2f2f2;
        width: 100%;
        border: 0;
        margin: 0 0 15px;
        padding: 15px;
        box-sizing: border-box;
        font-size: 14px;
    }

    .form button {
        font-family: "Roboto", sans-serif;
        text-transform: uppercase;
        outline: 0;
        background: #4CAF50;
        width: 100%;
        border: 0;
        padding: 15px;
        color: #FFFFFF;
        font-size: 14px;
        -webkit-transition: all 0.3 ease;
        transition: all 0.3 ease;
        cursor: pointer;
    }

    .form button:hover,
    .form button:active,
    .form button:focus {
        background: #43A047;
    }

    .form .message {
        margin: 15px 0 0;
        color: #b3b3b3;
        font-size: 12px;
    }

    .form .message a {
        color: #4CAF50;
        text-decoration: none;
    }

    .form .register-form {
        display: none;
    }

    .container {
        position: relative;
        z-index: 1;
        max-width: 300px;
        margin: 0 auto;
    }

    .container:before,
    .container:after {
        content: "";
        display: block;
        clear: both;
    }

    .container .info {
        margin: 50px auto;
        text-align: center;
    }

    .container .info h1 {
        margin: 0 0 15px;
        padding: 0;
        font-size: 36px;
        font-weight: 300;
        color: #1a1a1a;
    }

    .container .info span {
        color: #4d4d4d;
        font-size: 12px;
    }

    .container .info span a {
        color: #000000;
        text-decoration: none;
    }

    .container .info span .fa {
        color: #EF3B3A;
    }

    body {
        background: #76b852;
        /* fallback for old browsers */
        background: -webkit-linear-gradient(right, #76b852, #8DC26F);
        background: -moz-linear-gradient(right, #76b852, #8DC26F);
        background: -o-linear-gradient(right, #76b852, #8DC26F);
        background: linear-gradient(to left, #76b852, #8DC26F);
        font-family: "Roboto", sans-serif;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }
</style>
<script>
    $(document).ready(function() {
        /* Xử lý đăng nhập*/
        $(".dangnhap").click(function() {
            var ten = $(".ten").val();
            var mk = $(".matkhau").val();
            var dntruyen = true;
            /* Kiểm tra điện thoại*/
            if (ten == "") {
                $(".dnloi").html("<div class='alert alert-danger'><strong>Không được để trống !</strong></div>");
            }
            /* Kiểm tra mật khẩu*/
            if (mk == "") {
                $(".dnloi2").html("<div class='alert alert-danger'><strong>Mật khẩu không được để trống !</strong></div>");
                dntruyen = false;
            } else if (mk.length > 30 || mk.length < 6) {
                $(".dnloi2").html("<div class='alert alert-danger'><strong>Độ dài mật khẩu ít nhất 6 ký tự và  không quá 30 ký tự !</strong></div>");
                dntruyen = false;
            } else {
                $(".dnloi2").html("");
            }
            /* Không lổi thì gửi dữ liệu đi bằng ajax */
            if (dntruyen == true) {
                $.ajax({
                    url: '{{route("admin_login")}}',
                    type: 'POST',
                    data: {
                        _token: '{{csrf_token()}}',
                        TEN: ten,
                        MK: mk
                    },
                    success: function(data) {
                        if (data.kq == 0) {
                            $(".dnloi3").html("UserName hoặc Password không đúng !");
                        } else {
                            // var sdt = data.sdt;
                            // var ma = data.ma;

                            // // $("#login").modal("hide");
                            // $(".top-bar__link").html("<ul><li><a  href='#' style='line-height: 40px;color: #FFF;'>( Đăng xuất )</a></li><li style='color: #FFF;line-height: 40px;'><i class='fa fa-address-book-o' style='font-size:20px; margin-right: 3px;'></i>  <a href='thongtin/" + ma + "' style='color: #CCC; cursor: pointer;'>" + sdt + "</a></li></ul>");
                            // location.reload();


                            $(".dnloi").html("");
                            $(".dnloi2").html("");
                            $(".dnloi3").html("Đăng nhập thành công");
                            location.replace('{{route("admin_index")}}');
                        }

                    }
                });
            }
        });
    });
</script>