@extends('mid.layout.index')
@section('content')
<div class="inner-header">
    <div class="container">
        <div class="pull-left">
            <h6 class="inner-title">{{$detail_type_product->name}}</h6>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<div class="container">
    <div id="content" class="space-top-none">
        <div class="main-content">
            <div class="space60">&nbsp;</div>
            <div class="row">
                <div class="col-sm-3">
                    <ul class="aside-menu">
                        @foreach ($type_product as $type)
                            <li><a href="{{route('show_typeproduct',['id'=> $type->id ,'slug' => $type->slug])}}">{{$type->name}}</a></li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-sm-9">
                    <div class="beta-products-list">
                        <h4><span class="text-danger">{{$detail_type_product->name}}</span></h4>
                        <div class="beta-products-details">
                            <p class="pull-left">{{ trans('message.count',['count' => count($detail_type_product->product)]) }} </p>
                            <div class="clearfix"></div>
                        </div>


                        <div class="row">
                            @foreach ($all_product_by_type as $product_by_type)
                                <div class="col-sm-4">
                                    <div class="single-item">
                                        @if ($product_by_type->promotion_price > 0 || $product_by_type->promotion_price != null )
                                            <div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>
                                        @endif
                                        <div class="single-item-header">
                                            <a href="{{route('show_detail',['id'=>$product_by_type->id ,'slug'=>$product_by_type->slug])}}"><img height="250px" width="250px" src="main/image/product/{{$product_by_type->image}}" alt="{{$product_by_type->image}}"></a>
                                        </div>
                                        <div class="single-item-body">
                                            <p class="single-item-title">{{$product_by_type->name}}</p>
                                            <p class="single-item-price">
                                                @if ($product_by_type->promotion_price != 0 || $product_by_type->promotion_price != null)
                                                    <span class="flash-del">{{number_format($product_by_type->unit_price)}} vnd</span>
                                                    <span class="flash-sale">{{number_format($product_by_type->promotion_price)}} vnd</span>
                                                @else
                                                    <span>{{number_format($product_by_type->unit_price)}} vnd</span>
                                                @endif
                                            </p>
                                        </div>
                                        <div class="single-item-caption">
                                            <a class="add-to-cart pull-left" href="{{route('show_order',['id'=> $product_by_type->id])}}"><i class="fa fa-shopping-cart"></i></a>
                                            <a class="beta-btn primary" href="{{route('show_detail',['id'=> $product_by_type->id ,'slug'=>$product_by_type->slug])}}">{{ trans('message.detail') }} <i class="fa fa-chevron-right"></i></a>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="row">{{$all_product_by_type->links()}}</div>
                    </div> <!-- .beta-products-list -->
                    <div class="space50">&nbsp;</div>
                </div>
            </div> <!-- end section with sidebar and main content -->
        </div> <!-- .main-content -->
    </div> <!-- #content -->
</div> <!-- .container -->
@endsection
