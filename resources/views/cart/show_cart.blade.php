@extends('users.layout')
@section('content')
<?php
$content = Cart::content();


?>
<div class="container">

	<table class="table table-hover">
		<thead>
			<tr>
				<th>Sản phẩm</th>
				<th>Số lượng</th>
				<th class=" text-center">Giá</th>
				<th class="text-center">Tổng</th>
				<th> </th>

			</tr>
		</thead>
		<tbody>
			@foreach($content as $v_content)
			<tr>
				<td class="col-sm-8 col-md-6">
					<div class="media">
						<a class="thumbnail pull-left" href="#"> <img class="media-object" src="{{URL::to('./img/'.$v_content->options->image)}}" style=" height: 72px;"> </a>
						<div class="media-body">

							<h5 style="font-weight: 500; " class="media-heading"><a style="color:black;" href="{{URL::to('./product-details/'.$v_content->options->slug)}}">{{$v_content->name}}</a></h5>

						</div>
					</div>
				</td>

				<form action="{{URL::to('/update-cart-quantity')}}" method="POST">
					{{ csrf_field() }}

					<td class="col-sm-1 col-md-1" style="text-align: center">
						<input style="width:80px" type="text" class="form-control" name="cart_quantity" value="{{$v_content->qty}}">
					</td>


					<td class="col-sm-1 col-md-1 text-center"><strong>{{number_format($v_content->price)}}</strong></td>
					<td class="col-sm-1 col-md-1 text-center"><strong><?php $subtotal = $v_content->price * $v_content->qty;
																		echo number_format($subtotal); ?></strong></td>
					<td class="col-sm-1 col-md-1" style="text-align: center">
						<input type="hidden" value="{{$v_content->rowId}}" name="rowId_cart" class="form-control">
						<input type="submit" value="Cập nhật" name="update_qty" class="btn btn btn-primary">
					</td>
				</form>
				<td class="col-sm-1 col-md-1">
					<a href="{{URL::to('/delete-to-cart/'.$v_content->rowId)}}">
						<button hretype="button" class="btn btn-danger">
							<span class="fa fa-remove"></span> Remove
						</button>
					</a>

				</td>
				<td class="col-sm-1 col-md-1">
					<div class="cart_quantity_button">

					</div>
				</td>

			</tr>

			@endforeach

			<tr>
				<td> </td>
				<td> </td>
				<td> </td>
				<td> </td>

				<td>
					<h5>Tổng tiền: </h5>
				</td>
				<td>
					<h4><strong>{{Cart::priceTotal().' '.'vnđ'}}</strong></h4>
				</td>
			</tr>
			<tr>
				<td> </td>
				<td> </td>
				<td> </td>
				<td> </td>
				<td>
					<a href="{{route('home')}}">
						<button type="button" class="btn btn-default">
							<span class="fa fa-shopping-cart"></span> Tiếp Tục Mua Sắm
						</button>
					</a>

				</td>
				<td>
					<button type="button" class="btn btn-success">
						Thanh Toán <span class="fa fa-play"></span>
					</button>
				</td>
			</tr>
		</tbody>
	</table>

</div>


@endsection