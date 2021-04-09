<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Huy</title>






  <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="{{asset('css/main.css')}}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>
  <header>
    <section class="top-bar">
      <div class="container">
        <div class="row">
          <div class="col">

          </div>
          <!-- Col này là col tìm kiếm đó -->
          <div class="col">


            <form class="input-group" action="{{URL::to('/search-product')}}" method="get" style="margin-top:2.5px">
              <input class="search-bar form-control" type="text" placeholder="Searching" name="search">
              <div class="input-group-append">
                <button class="btn btn-secondary searchbtn" name="ok" type="submit">
                  <i class="fa fa-search"></i>
                </button>
              </div>
            </form>
          </div>

          <!-- Kết thúc col -->
          <div class="col">
            <div class="top-bar__link ">
              <?php $makh = Session::get('id_customer'); ?>
              @if(Session::has('id_customer'))
              <!-- Button đăng ký, đăng nhập -->
              <ul>
                <li><a href="{{route('logout')}}" style="line-height: 40px;color: #FFF;">( Đăng xuất )</a></li>

                <li><a style="color: #CCC; cursor: pointer;line-height: 40px;" href="{{route('giohang')}}"><i class="fa fa-shopping-cart"></i> Giỏ hàng</a></li>
                <li style="color: #FFF;line-height: 40px;"><i class="fa fa-address-book-o" style="font-size:20px; margin-right: 3px;"></i> <a data-target="#register" href="{{asset("thongtin/{$makh}")}}" style="color: #CCC; cursor: pointer;">{{Session::get('name_customer')}}</a></li>
              </ul>
              @else
              <ul>

                <li><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#register">Đăng ký</button></li>
                <li><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#login">Đăng nhập</button></li>
              </ul>
              @endif
            </div>
          </div>
        </div>
      </div>
      </div>
    </section>
    <section class="bottom-bar">
      <div class="container">
        <div class="row">
          <div class="col-2">
            <img src="{{asset('img/logo1.png')}}" alt="" class="top-nav__logo">
          </div>
          <div class="col-10">
            <nav class="navbar navbar-expand-sm justify-content-center">
              <ul class="navbar-nav">
                <li class="nav-item active">
                  <a class="nav-link" href="{{route('home')}}">Trang chủ</a>
                </li>
                @foreach($Phone as $phone)
                @if($phone->category_parent == 0)
                <!-- lấy thằng cha -->
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle " id="navbarDropdown" role="button" data-toggle="dropdown">{{$phone->category_name}}</a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    @foreach($Phone as $o)
                    @if($o->category_parent == $phone->category_id)
                    <!-- lấy thằng con -->
                    <a class="dropdown-item" href="{{URL::to('/category-product/'.$o->category_id)}}">{{$o->category_name}}</a>
                    <div class="dropdown-divider"></div>
                    @endif
                    @endforeach
                  </div>
                </li>
                @endif
                @endforeach
                <li class="nav-item">
                  <a class="nav-link" href="#">Liên Hệ</a>
                </li>
              </ul>
            </nav>
          </div>
        </div>
      </div>
    </section>
  </header>
  <main>
    @yield('content')
  </main>
  <footer>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="inner-content">
            <p>Copyright &copy; <a rel="nofollow noopener" href="https://templatemo.com" target="_blank">TemplateMo</a></p>
          </div>
        </div>
      </div>
    </div>
  </footer>

  @extends('users.user_reg')

  @extends('users.user_login')
</body>

</html>
<script type="text/javascript">
  $(document).ready(function() {
    /* Xử lý đăng ký */
    $(".dangky").click(function() {
      var sdt = $(".dienthoai").val();
      var email = $(".email").val();
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
      } else {
        $(".loi").html("<div class='alert alert-danger'><strong>Số điện thoại không được để trống !</strong></div>");
        truyen = false;
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
      var name = $(".txtname").val();
      if (name.search(bieuthuc2) == -1) {
        $(".loi6").html("<div class='alert alert-danger'><strong>Tên bạn nhập không hợp lệ !</strong></div>");
        truyen = false;
      } else {
        $(".loi6").html("");
      }
      /*Kiểm tra mật khẩu */
      var mk = $(".matkhau").val();
      var rmk = $(".rematkhau").val();
      var xemmk = true;
      if (mk == "") {
        $(".loi2").html("<div class='alert alert-danger'><strong>Mật khẩu không được để trống !</strong></div>");
        truyen = false;
        xemk = false;
      } else if (mk.length > 30 || mk.length < 6) {
        $(".loi2").html("<div class='alert alert-danger'><strong>Độ dài mật khẩu ít nhất 6 ký tự và  không quá 30 ký tự !</strong></div>");
        truyen = false;
        xemmk = false;
      } else {
        $(".loi2").html("");
      }
      /*Kiểm tra repassword*/
      if (rmk == "") {
        $(".loi3").html("<div class='alert alert-danger'><strong>Nhập lại mật khẩu không được để trống !</strong></div>");
        truyen = false;
        xemmk = false;
      } else if (rmk.length > 30 || rmk.length < 6) {
        $(".loi3").html("<div class='alert alert-danger'><strong>Nhập lại mật khẩu có độ dài không đúng!</strong></div>");
        truyen = false;
        xemmk = false;
      } else {
        $(".loi3").html("");
      }
      /*Kiểm tra nhập lại mật khẩu đúng không*/
      if (xemmk == true && mk != rmk) {
        $(".loi4").html("<div class='alert alert-danger'><strong>Nhập lại mật khẩu không giống mật khẩu!</strong></div>");
        truyen = false;
      } else {
        $(".loi4").html("");
      }
      /*Kiểm tra xem đúng chưa để mở ajax truyền dữ liệu đi*/
      if (truyen == true) {
        $.ajax({
          url: '{{route("dangky")}}',
          type: 'POST',
          data: {
            _token: '{{csrf_token()}}',
            SDT: sdt,
            MK: mk,
            NAME: name,
            EMAIL: email
          },
          success: function(data) {
            if (data.kq == 0) {
              $(".loi5").html("<div class='alert alert-danger'><strong>Xin lổi - Số điện thoại hoặc Email này đã đăng ký tài khoản trước đó !</strong></div>");
            } else if (data.kq == 1) {
              $(".dangkytc").html("<div class='alert alert-success'><strong>Bạn đã đăng ký thành công, bấm <a href='javascript:void(0);' data-toggle='modal' data-target='#login' data-dismiss='modal' class='btn btn-link'>Đăng nhập</a> để tiếp tục</trong></div>");
            }

          }
        });
      }
    });
    /* Kết thúc xử lý đăng ký*/
    /* Xử lý đóng đăng ký*/
    $(".dongdangky").click(function() {
      $(".loi").html("");
      $(".loi2").html("");
      $(".loi3").html("");
      $(".loi4").html("");
      $(".loi5").html("");
      $(".dangkytc").html("");
    });
    /* Xử lý đăng nhập*/
    $(".dangnhap").click(function() {
      var dndt = $(".dndienthoai").val();
      var dnemail = $(".dndienthoai").val();
      var dnmk = $(".dnmatkhau").val();
      var bieuthuc = /^(0[3578]|09)[0-9]{8}$/;
      var dntruyen = true;
      /* Kiểm tra điện thoại*/
      if (dndt == "") {
        $(".dnloi").html("<div class='alert alert-danger'><strong>Không được để trống !</strong></div>");
      }
      /* Kiểm tra mật khẩu*/
      if (dnmk == "") {
        $(".dnloi2").html("<div class='alert alert-danger'><strong>Mật khẩu không được để trống !</strong></div>");
        dntruyen = false;
      } else if (dnmk.length > 30 || dnmk.length < 6) {
        $(".dnloi2").html("<div class='alert alert-danger'><strong>Độ dài mật khẩu ít nhất 6 ký tự và  không quá 30 ký tự !</strong></div>");
        dntruyen = false;
      } else {
        $(".dnloi2").html("");
      }
      /* Không lổi thì gửi dữ liệu đi bằng ajax */
      if (dntruyen == true) {
        $.ajax({
          url: '{{route("dangnhap")}}',
          type: 'POST',
          data: {
            _token: '{{csrf_token()}}',
            DNDT: dndt,
            DNEMAIL: dnemail,
            DNMK: dnmk
          },
          success: function(data) {
            if (data.kq == 0) {
              $(".dnloi3").html("<div class='alert alert-danger'><strong>Số điện thoại hoặc mật khẩu không đúng !</strong></div");
            } else {
              var sdt = data.sdt;
              var ma = data.ma;

              $("#login").modal("hide");
              $(".top-bar__link").html("<ul><li><a  href='#' style='line-height: 40px;color: #FFF;'>( Đăng xuất )</a></li><li style='color: #FFF;line-height: 40px;'><i class='fa fa-address-book-o' style='font-size:20px; margin-right: 3px;'></i>  <a href='thongtin/" + ma + "' style='color: #CCC; cursor: pointer;'>" + sdt + "</a></li></ul>");
              location.reload();
            }

          }
        });
      }
    });
    /* Kết thức xử lý đăng nhập*/
    $(".dongdangnhap").click(function() {
      $(".dnloi").html("");
      $(".dnloi2").html("");
      $("dnloi3").html("");
    });
  });
</script>
@extends('users.user_login')
@extends('users.user_reg')
@yield('script')