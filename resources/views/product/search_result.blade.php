@extends('users.layout')
@section('content')


<?php
$sname = "localhost";
$unmae = "root";
$password = "";

$db_name = "elaravel_auth";
$conn = mysqli_connect($sname, $unmae, $password, $db_name);
if (!$conn) {
    echo "connection failed!";
}
if (isset($_REQUEST['ok'])) {

    $search = addslashes($_GET['search']);

    // Nếu $search rỗng thì báo lỗi, tức là người dùng chưa nhập liệu mà đã nhấn submit.
    if (empty($search)) {
        echo '<div style="margin-left:200px;margin-top:20px;"> <h4>' . 0 . ' sản phẩm tìm được với từ khóa " <b> </b> "  </h4></div>';

    } else {
        $query = "select * from tbl_product where product_name like '%$search%'";
        $sql = mysqli_query($conn, $query);
        $num = mysqli_num_rows($sql);

        if ($num > 0 && $search != "") {
            echo '<div style="margin-left:200px;margin-top:20px;"> <h4>' . $num . ' sản phẩm tìm được với từ khóa " <b>' . $search . '</b> "  </h4></div>';
            echo'<div class="container" style="margin-top:50px">
	                <div class="row">';
            while ($row = mysqli_fetch_assoc($sql)) { ?>
            <div  class="col-md-3">
			<div class="product-item"><?php
                echo '<a class="" href="./product-details/' . $row['product_slug'] . '"target="_self"> <img src="' . $row['product_image'] . '" alt="' . $row['product_image'] . '"></a>'; ?>
             <div class="down-content">
				<div class="title">
                    <?php echo '<a class="" href="./product-details/' . $row['product_slug'] . '"target="_self">' . $row['product_name'] . '"</a><br>';
				?></div>
				</div>
			</div>
		</div>
           <?php };
        } else {
            echo '<div style="margin-left:200px;margin-top:20px;"> <h4>' . 0 . ' sản phẩm tìm được với từ khóa " <b>' . $search . '</b> "  </h4></div>';

        }
    }
}
?>
@endsection


		
