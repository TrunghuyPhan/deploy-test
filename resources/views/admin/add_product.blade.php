@extends('admin.admin_layout')
@section('content')
<div class="main container">
    <div class="content wo-table" style="margin-top:20px">
        <div class="heading-wrap" style="display:inline-block;">
            <h2 class="heading-table">
                <i class="fa fa-wrench"></i>Thêm sản phẩm mới
            </h2>
        </div>
        <form role="form" action="{{URL::to('/save-product')}}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên sản phẩm</label>
                            <input type="text" data-validation="length" data-validation-length="min10" data-validation-error-msg="Làm ơn điền ít nhất 10 ký tự" name="product_name" class="form-control" id="exampleInputEmail1">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Giá sản phẩm</label>
                            <input type="text" data-validation="number" data-validation-error-msg="Làm ơn điền số tiền" name="product_price" class="form-control" id="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Slug</label>
                            <input type="text" name="product_slug" class="form-control" id="exampleInputEmail1">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="exampleInputPassword1">Danh mục sản phẩm</label>
                            <select name="product_cate" class="form-control input-sm m-bot15">
                                <option value="">Chọn danh mục</option>
                                @foreach($cate_product as $key => $cate)

                                @if($cate->category_parent!=0)
                                <option value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Hình ảnh sản phẩm</label>
                            <input type="text" name="product_image" class="form-control" placeholder="Nhập vào Link của hình ảnh" id="exampleInputEmail1">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả sản phẩm</label>
                            <textarea style="resize: none" rows="8" class="form-control" name="product_desc" id="ckeditor1" placeholder="Mô tả sản phẩm"></textarea>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-12" style="margin-bottom: 20px;text-align:center">
                        <button type="submit" name="add_product" class="btn btn-info">Thêm sản phẩm</button>
                    </div>
                </div>

            </div>

        </form>
    </div>


</div>
@endsection