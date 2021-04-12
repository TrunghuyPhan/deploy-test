@extends('admin.admin_layout')
@section('content')
<div class="main container">

    <div class="content wo-table">

        <div class="header-content master-container">

            <div class="heading-wrap">
                <h2 class="heading-table">
                    <i class="fa fa-wrench"></i>Quản lý sản phẩm
                </h2>
            </div>

            <div class="button-wrap">
                <a href="{{route('admin_add_pro')}}">
                    <button class="new-input">
                        <i class="fa fa-plus-square-o new-icon" style=" font-size: 17px;"></i>Thêm sản phẩm mới
                    </button>
                </a>

            </div>
        </div>


        <div class="table card">

            <table>
                <tr>
                    <th>ID</th>
                    <th>Tên sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Danh mục</th>
                    <th>Giá</th>
                    <th>Ảnh</th>
                    <th></th>
                    <th></th>


                </tr>
                @foreach($all_product as $item)
                <tr>
                    <td>{{$item->product_id}}</td>
                    <td>{{$item->product_name}}</td>
                    <td>{{$item->product_quantity}}</td>
                    <td>{{$item->category_id}}</td>
                    <td>{{$item->product_price}}</td>
                    <td><img style="width: 100px;" src="/img/{{$item->product_image}}"></td>
                    <td><button class="btn btn-warning">Sửa</button></td>
                    <td><button class="btn btn-danger">Xoá</button></td>
                </tr>

                @endforeach
            </table>

            <div style="margin-left:500px; marfin-top:50px">
                {!! $all_product->links() !!}
            </div>
        </div>
    </div>


</div>
@endsection