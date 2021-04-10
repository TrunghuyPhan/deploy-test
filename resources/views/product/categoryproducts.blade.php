@extends('users.layout')
@section('content')
<div class="container" style="margin-top: 50px;">
  <div class="section-heading">
    @foreach($category_pro as $product)
    <h2>{{$product->category_name}}</h2>
    @endforeach
  </div>
  <div class="row">
    @foreach($category_pro as $product)
    <div class="col-md-4">
      <div class="product-item">
        <a href="{{URL::to('/product-details/'.$product->product_slug)}}"><img src="{{URL::to('/img/'.$product->product_image)}}" alt=""></a>
        <div class="down-content">
          <div class="title">
            <a href="{{URL::to('/product-details/'.$product->product_slug)}}">
              <h4>{{$product->product_name}}</h4>
            </a>
          </div>
          <div class="price">
            <h6>{{$product->product_price/1000}}.000VNĐ</h6>
          </div>

          <ul class="stars">
            <li><i class="fa fa-star"></i></li>
            <li><i class="fa fa-star"></i></li>
            <li><i class="fa fa-star"></i></li>
            <li><i class="fa fa-star"></i></li>
            <li><i class="fa fa-star"></i></li>
          </ul>
          <span>Reviews (24)</span>
        </div>
      </div>
    </div>
    @endforeach

  </div>
</div>

@endsection