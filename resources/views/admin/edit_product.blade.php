@extends('admin.admin_layout')
@section('content')
<div class="main container">
    <?php
    $message = Session::get('message');
    if ($message) {
        echo '<span class="text-alert">' . $message . '</span>';
        Session::put('message', null);
    }
    ?>
    <div class="content wo-table" style="margin-top:20px">
        <div class="heading-wrap" style="display:inline-block;">
            <h2 class="heading-table">
                <i class="fa fa-wrench"></i>Cập nhật sản phẩm
            </h2>
        </div>
        @foreach($edit_product as $key => $pro)
        <div class="row">
            <div class="col-4"></div>
            <div class="col-4" style="margin-top:20px">
                <img src="{{$pro->product_image}}" height="200">
            </div>
            <div class="col-4"></div>
        </div>
        <form role="form" action="{{URL::to('/update-product/'.$pro->product_id)}}" style="margin-top:20px" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="exampleInputEmail1"><strong>Tên sản phẩm</strong></label>
                            <input type="text" name="product_name" class="form-control" id="exampleInputEmail1" value="{{$pro->product_name}}">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="exampleInputEmail1"><strong>Giá sản phẩm</strong></label>
                            <input type="text" value="{{$pro->product_price}}" name="product_price" class="form-control" id="exampleInputEmail1">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="exampleInputEmail1"><strong>Hình ảnh sản phẩm</strong></label>
                            <input type="text" name="product_image" class="form-control" placeholder="Sử dụng Link" id="exampleInputEmail1">

                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="exampleInputPassword1"><strong>Danh mục sản phẩm</strong> </label>
                            <select name="product_cate" class="form-control input-sm m-bot15">
                                @foreach($cate_product as $key => $cate)
                                @if($cate->category_id==$pro->category_id)
                                <option selected value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                @else
                                @if($cate->category_parent!=0)
                                <option value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                @endif
                                @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="exampleInputPassword1"><strong>Mô tả sản phẩm</strong></label>
                            <textarea style="resize: none" rows="8" class="form-control" name="product_desc" id="exampleInputPassword1">{{$pro->product_desc}}</textarea>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-12" style="margin-bottom: 20px;text-align:center">
                        <button type="submit" name="add_product" class="btn btn-info">Cập nhật sản phẩm</button>
                    </div>
                </div>

            </div>

        </form>








        @endforeach
    </div>


</div>
@endsection