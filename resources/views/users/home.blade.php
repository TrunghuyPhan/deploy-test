@extends('users.layout')
@section('content')
<div class="banner header-text">
  <div class="owl-banner owl-carousel">
    <div class="banner-item-01">
      <div class="text-content">
        <h4>Best Offer</h4>
        <h2>New Arrivals On Sale</h2>
      </div>
    </div>
  </div>
</div>

<div class="latest-products">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="section-heading">
          <h2>Sản phẩm mới nhất</h2>
          <a href="{{route('allproduct')}}">Xem tất cả <i class="fa fa-angle-right"></i></a>
        </div>
      </div>
      @foreach($all_product as $key => $product)
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
</div>

@endsection