@extends('users.layout')
@section('content')
<div class="container" style="margin-top:50px">
  <div id="carouselExampleSlidesOnly" class="carousel slide carousel-fade" data-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img class="d-block w-100" src="https://cdn.tgdd.vn/2021/04/banner/S21-800-300-800x300.png" alt="First slide">
      </div>
      <div class="carousel-item">
        <img class="d-block w-100" src="https://cdn.tgdd.vn/2021/03/banner/reno5-800-300-800x300-2.png" alt="Second slide">
      </div>
      <div class="carousel-item">
        <img class="d-block w-100" src="https://cdn.tgdd.vn/2021/04/banner/iphone-chung-800-300-800x300-1.png" alt="Third slide">
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
          <a href="{{URL::to('/product-details/'.$product->product_slug)}}"><img src="{{$product->product_image}}" alt=""></a>
          <div class="down-content">
            <div class="title">
              <a href="{{URL::to('/product-details/'.$product->product_slug)}}">
                <h4>{{$product->product_name}}</h4>
              </a>
            </div>
            <div class="price">
              <h6>{{number_format($product->product_price)}}&#8363</h6>
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
<script>
  $('.carousel').carousel({
    interval: 2000
  })
</script>
@endsection