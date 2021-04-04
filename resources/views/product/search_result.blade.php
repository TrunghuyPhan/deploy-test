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
        echo '<p class="">0 Result!</p>';
    } else {
        $query = "select * from tbl_product where product_name like '%$search%'";
        $sql = mysqli_query($conn, $query);
        $num = mysqli_num_rows($sql);

        if ($num > 0 && $search != "") {
            echo '<p class=" ">' . $num . ' results with key " <b>' . $search . '</b> " <br> </p>';
            while ($row = mysqli_fetch_assoc($sql)) {
                echo '<img src="./img/' . $row['product_image'] . '" alt="' . $row['product_image'] . '">';
                echo '<a class="" href="./product-details/' . $row['product_slug'] . '"target="_self">' . $row['product_name'] . '"</a><br>';
            };
        } else {
            echo '<p class="">0 Result!</p>';
        }
    }
}
?>
@endsection