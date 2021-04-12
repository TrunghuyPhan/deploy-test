<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">



</head>

<body>


    <div class="master-container">

        <div class="menu container">

            <div class="box-user">
                <div class="avatar">
                    <img src="https://thecrucible.org/wp-content/uploads/default_bio_600x600-1.jpg" alt="Girl in a jacket" width="50" height="50">
                </div>
                <p class="user-info">
                    <span id="fullname" class="profil-text">
                        <?php $makh = Session::get('name_admin');
                        echo ($makh);
                        ?>
                    </span>
                </p>

            </div>

            <div class="main-nav">
                <a href="#"><span class="active-menu"><i class="fa fa-home"></i>Trang chủ</span></a>
                <a href="{{route('admin_index')}}"><i class="fa fa-home"></i>Quản lý sản phẩm</a>
                <a href="{{route('admin_index')}}"><i class="fa fa-home"></i>Quản lý danh mục</a>
                <a href="{{route('admin_logout')}}"><i class="fa fa-power-off"></i>Đăng Xuất</a>
            </div>
        </div>


        @yield('content')



    </div>

</body>
<style>
    body {
        margin: 0px !important;
    }

    p,
    li,
    table {
        FONT-FAMILY: "Poppins", sans-serif;
        font-size: 14px;
        line-height: 25px;
    }

    .master-container {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-wrap: wrap;
        flex-wrap: wrap;
    }

    /*grid menu main*/
    .menu {
        width: 15%;
        flex: 0 0 15%;
        background-color: white;
        color: #79818e;
        height: 100%;
    }


    .main {
        width: 85%;
        flex: 0 0 85%;
        background-color: #f1f5f7;
        max-height: 100vh;
        overflow-y: auto;
    }

    /*grid title button table*/

    .heading-wrap {
        width: 75%;
        flex: 0 0 75%;
    }


    .button-wrap {
        width: 25%;
        flex: 0 0 25%;
    }




    .content {
        margin: 0px 2rem 3rem;


    }

    /*user box*/
    .box-user {
        margin-top: 25px;
        border-bottom: 5px solid #4e62c0;
    }


    .avatar img {
        display: block;
        margin-left: auto;
        margin-right: auto;
        border-radius: 50%;
    }

    .user-info {
        text-align: center;
    }

    #fullname {
        font-size: 18px;
        font-weight: 700;
    }

    #jabatan {
        font-size: 14px;
    }


    /*menu main nav css*/

    .main-nav {
        margin-top: 15px;
        padding: 0 25px;
        color: darkgray !important;
    }

    .main-nav a,
    .main-nav button {
        color: #79818e;
        font-family: "Poppins", sans-serif;
        font-size: 14px;
        font-weight: 600;
        width: max-content;

    }

    .main-nav a:hover,
    .main-nav button:hover {
        color: #4e62c0;
    }

    .active-menu {
        color: #4e62c0;

    }


    .wo-child,
    .po-child {
        padding-left: 25px;
    }

    .main-nav a,
    .main-nav button {
        display: block;
        text-decoration: none;
        padding: 12px;
        border: none;
        background: none;
        width: 100%;
        text-align: left;
        cursor: pointer;
        outline: none;
    }

    /*header tabel*/
    .header-content {
        background-color: ;
        position: relative;
        display: flex;
        margin-top: 25px;
    }

    h2.heading-table {
        margin-bottom: 0px;
        margin-top: 0px;
        padding: 25px;
        border-radius: 5px 5px;
        float: left;

    }

    .new-input {
        background-color: white;
        top: 1.5rem;
        right: 3rem;
        position: absolute;
        padding: 10px;
        border-radius: 6px;
        outline: 0px;
        background-color: #4e62c0;
        color: white;
        font-weight: bold;
    }


    .new-icon {
        color: white;
        margin-right: 10px;
    }

    .fa {
        margin-right: 10px;
    }


    /*Table CSS*/
    .wo-table {
        background-color: white;
        border-radius: 7px;
        box-shadow: 0 0 15px -4px black;
    }

    table {
        border-collapse: collapse;
        width: 100%;
    }


    th {
        line-height: 19px;
        color: #2E5266;
        padding: 10px;
        border-bottom: 5.5px solid lightgray;
        text-align: left;
    }

    .fa-sort {
        margin-left: 5px;
    }


    td {
        border-bottom: 0.5px solid lightgray;
    }



    td {
        padding: 15px;
        text-align: left;
        line-height: 20px;
    }

    tr:hover {
        background-color: #f1f5f7;
    }


    tr:nth-child(even) {
        background-color: ;
    }

    /*Status CSS*/
    .status {
        padding: 8px;
        border-radius: 4px;
    }



    .urgent {
        background-color: black;
        color: white;
    }

    .major {
        background-color: #dc3545;
        color: white;
    }

    .medium {
        background-color: #ffc107;
        color: white;
    }

    .minor {
        background-color: #439ab3;
        color: white;
    }

    .solved {
        background-color: #83b343;
        color: white;
    }

    .fa-pencil:hover {
        color: #4e62c0;
        cursor: pointer;
    }

    /*Pagination*/
    .pagination {
        margin-top: 7px;
        margin-bottom: 7px;
        display: inline-flex;

    }

    .pagination a {
        color: black;
        float: left;
        padding: 6px 14px;
        text-decoration: none;
        transition: background-color .3s;
    }

    .pagination a.active {
        background-color: #4e62c0;
        color: white;
        border-radius: 5px;
    }

    .pagination a:hover:not(.active) {
        background-color: #ddd;
        border-radius: 5px;
    }

    /*Item per page*/
    .dropbtn {
        background-color: #4e62c0;
        color: white;
        padding: 7px;
        font-size: 12px;
        border-radius: 5px;
        cursor: pointer;
        margin: 10px 9px;
    }


    .dropdown {
        float: right;
        position: relative;
        display: inline-block;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f1f1f1;
        overflow: auto;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        right: 0;
        z-index: 1;
        width: 75px;
        text-align: center;
    }

    .dropdown-content a {
        color: black;
        padding: 5px 5px;
        text-decoration: none;
        display: block;
    }

    .dropdown a:hover {
        background-color: #ddd;
    }

    .show {
        display: block;
    }
</style>
<script>
    $(document).ready(function() {
        $(".wo-parent").click(function() {
            $(".wo-child").toggle(500);
        });
    });

    $(document).ready(function() {
        $(".po-parent").click(function() {
            $(".po-child").toggle(500);
        });
    });

    $(document).ready(function() {
        $(".dropbtn").click(function() {
            $("#myDropdown").toggle();
        });
    });

    $(document).ready(function() {
        $(".dropbtn2").click(function() {
            $("#myDropdown2").toggle();
        });
    });
</script>