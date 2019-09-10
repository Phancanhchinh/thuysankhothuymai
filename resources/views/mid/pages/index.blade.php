
@extends('mid.layout.index')
@section('content')
	@include('mid.layout.slide')
	{{-- content --}}
    <div class="container">
		<div id="content" class="space-top-none">
			<div class="main-content">
				<div class="space60">&nbsp;</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="beta-products-list">
							<h4>{{ trans('message.newProduct') }}</h4>
							<div class="beta-products-details">
								<p class="pull-left"> {{ trans('message.product',['new_product' => count($new_product)]) }}</p>
								<div class="clearfix"></div>
							</div>
							<div class="row">
								@foreach ($new_product as $data)
									<div class="col-sm-3">
										<div class="single-item">
											@if ($data->promotion_price > 0 || $data->promotion_price != null )
												<div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>
											@endif
											<div class="single-item-header">
												<a href="{{route('show_detail',['id'=>$data->id,'slug'=>$data->slug])}}"><img height="250px" width="250px" src="main/image/product/{{$data->image}}" alt="{{$data->image}}"></a>
											</div>
											<div class="single-item-body">
												<p class="single-item-title">{{$data->name}}</p>
												<p class="single-item-price">
													<p class="single-item-price">
															@if ($data->promotion_price != 0 || $data->promotion_price != null)
																<span class="flash-del">{{number_format($data->unit_price)}} vnd</span>
																<span class="flash-sale">{{number_format($data->promotion_price)}} vnd</span>
															@else
																<span>{{number_format($data->unit_price)}} vnd</span>
															@endif
													</p>
                                            </div>
                                            {{-- {!!url('them-gio-hang',[$data->id])!!} --}}
											<div class="single-item-caption">
												<a class="add-to-cart pull-left" href="{{route('show_order',['id'=> $data->id])}}"><i class="fa fa-shopping-cart"></i></a>
												<a class="beta-btn primary" href="{{route('show_detail',['id'=>$data->id,'slug'=>$data->slug])}}">{{ trans('message.detail') }} <i class="fa fa-chevron-right"></i></a>
												<div class="clearfix"></div>
											</div>
										</div>
									</div>
								@endforeach
						</div> <!-- .beta-products-list -->
						<div class="row">{{$new_product->links()}}</div>
						<div class="space50">&nbsp;</div>

						<div class="beta-products-list">
							<h4>{{ trans('message.saleProduct')}}</h4>
							<div class="beta-products-details">
								<p class="pull-left"> {{ trans('message.product',['new_product' => count($sale_product)]) }}</p>
								<div class="clearfix"></div>
							</div>
							<div class="row">

								@foreach ($sale_product as $sale)
									<div class="col-sm-3">
										<div class="single-item">
											<div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>
											<div class="single-item-header">
												<a href="{{route('show_detail',['id'=>$sale->id,'slug'=>$sale->slug])}}"><img height="250px" width="250px" src="main/image/product/{{$sale->image }}" alt="{{$sale->image}}"></a>
											</div>
											<div class="single-item-body">
												<p class="single-item-title">{{$sale->name}}</p>
												<p class="single-item-price">
													<span class="flash-del">{{number_format($sale->unit_price)}} vnd</span>
													<span class="flash-sale">{{number_format($sale->promotion_price)}} vnd</span>
												</p>
											</div>
											<div class="single-item-caption">
												<a class="add-to-cart pull-left" href="{{route('show_order',['id'=> $sale->id])}}"><i class="fa fa-shopping-cart"></i></a>
												<a class="beta-btn primary" href="{{route('show_detail',['id'=>$sale->id,'slug'=>$sale->slug])}}">{{ trans('message.detail') }} <i class="fa fa-chevron-right"></i></a>
												<div class="clearfix"></div>
											</div>
										</div>
									</div>
								@endforeach
							</div>
							<div class="row">{{$sale_product->links()}}</div>
							<div class="space40">&nbsp;</div>
							</div>
						</div> <!-- .beta-products-list -->
					</div>
				</div> <!-- end section with sidebar and main content -->


			</div> <!-- .main-content -->
		</div> <!-- #content -->
	</div> <!-- .container -->
    {{-- content --}}
@endsection
