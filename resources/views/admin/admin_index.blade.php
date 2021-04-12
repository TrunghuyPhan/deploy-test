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
                <a href="{{route('addproduct')}}">
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
                    <td><strong>{{$item->product_id}}</strong></td>
                    <td><strong>{{$item->product_name}}</strong></td>
                    <td><strong>{{$item->product_quantity}}</strong></td>
                    <td><strong>{{$item->category_name}}</strong></td>
                    <td><strong>{{number_format($item->product_price)}}</strong></td>
                    <td><img style="width: 100px;" src="{{$item->product_image}}"></td>
                    <td><a href="{{URL::to('/edit-product/'.$item->product_id)}}"><button class="btn btn-warning">Sửa</button></a></td>
                    <td><a href="{{URL::to('/delete-product/'.$item->product_id)}}"><button class="btn btn-warning">Xóa</button></a></td>

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