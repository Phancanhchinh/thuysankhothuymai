
@extends('mid.layout.index')
@section('content')
<div class="inner-header">
    <div class="container">
        <div class="pull-left">
            <h6 class="inner-title">{{$one_product->name}}</h6>
        </div>
        <div class="pull-right">
            <div class="beta-breadcrumb font-large">
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<div class="container">
    <div id="content">
        <div class="row">
            <div class="col-sm-9">

                <div class="row">
                    <div class="col-sm-4">
                        <img height="250px" width="250px" src="main/image/product/{{$one_product->image}}" alt="{{$one_product->image}}">
                    </div>
                    <div class="col-sm-8">
                        <div class="single-item-body">
                            <p class="single-item-title">{{$one_product->name}}</p>
                            <p class="single-item-price">
                                {{number_format($one_product->unit_price)}} vnd
                            </p>
                        </div>
                        <div class="clearfix"></div>
                        <div class="space20">&nbsp;</div>
                        <div class="single-item-options">
                            <a class="add-to-cart" href="{{route('show_order',['id'=> $one_product->id])}}"><i class="fa fa-shopping-cart"></i></a>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <div class="space40">&nbsp;</div>
                <div class="woocommerce-tabs">
                    <ul class="tabs">
                        <li><a href="#tab-description">{{ trans('message.description') }}</a></li>
                        <li><a href="#tab-reviews">{{ trans('message.comment') }}</a></li>
                    </ul>

                    <div class="panel" id="tab-description">
                        <p>{{$one_product->description}}</p>
                    </div>
                    <div class="panel" id="tab-reviews">
                        <p>No Reviews</p>
                    </div>
                </div>
                <div class="space50">&nbsp;</div>
                <div class="beta-products-list">
                    <h4>{{ trans('message.related') }}</h4>
                    <div class="row">
                        @foreach ($product_relate as $relate)
                            <div class="col-sm-4">
                                    <div class="single-item">
                                            @if ($relate->promotion_price > 0 || $relate->promotion_price != null )
                                                <div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>
                                            @endif
                                            <div class="single-item-header">
                                                <a href="{{route('show_detail',['id'=>$relate->id,'slug'=>$relate->slug])}}"><img height="250px" width="250px" src="main/image/product/{{$relate->image}}" alt="{{$relate->image}}"></a>
                                            </div>
                                            <div class="single-item-body">
                                                <p class="single-item-title">{{$relate->name}}</p>
                                                <p class="single-item-price">
                                                    @if ($relate->promotion_price != 0 || $relate->promotion_price != null)
                                                        <span class="flash-del">{{number_format($relate->unit_price)}} vnd</span>
                                                        <span class="flash-sale">{{number_format($relate->promotion_price)}} vnd</span>
                                                    @else
                                                        <span>{{number_format($relate->unit_price)}} vnd</span>
                                                    @endif
                                                </p>
                                            </div>
                                            <div class="single-item-caption">
                                                <a class="add-to-cart pull-left" href="{{route('show_order',['id'=> $relate->id])}}"><i class="fa fa-shopping-cart"></i></a>
                                                <a class="beta-btn primary" href="{{route('show_detail',['id'=>$relate->id,'slug'=>$relate->slug])}}">{{ trans('message.detail') }} <i class="fa fa-chevron-right"></i></a>
                                                <div class="clearfix"></div>
                                            </div>
                                    </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="row">{{$product_relate->links()}}</div>
                </div> <!-- .beta-products-list -->
            </div>
            <div class="col-sm-3 aside">
                <div class="widget">
                    @if (count($array_product) > 0)
                        <h3 class="widget-title">{{ trans('message.hot') }}</h3>
                        <div class="widget-body">
                            <div class="beta-sales beta-lists">
                                @for($i = 0; $i < count($array_product); $i++)
                                    <div class="media beta-sales-item">
                                            <a class="pull-left" href="{{route('show_detail',['id'=> $array_product[$i]->id,'slug'=>$array_product[$i]->slug ])}}"><img src="main/image/product/{{$array_product[$i]->image}}" alt="{{$array_product[$i]->image}}"></a>
                                            <div class="media-body">
                                                {{$array_product[$i]->name}}
                                            </div>
                                    </div>
                                @endfor
                            </div>
                        </div>
                    @endif
                </div> <!-- best sellers widget -->
                <div class="widget">
                    <h3 class="widget-title">{{ trans('message.newProduct') }}</h3>
                    <div class="widget-body">
                        @foreach ($new_p as $new)
                            <div class="beta-sales beta-lists">
                                    <div class="media beta-sales-item">
                                        <a class="pull-left" href="{{route('show_detail',['id'=> $new->id,'slug'=>$new->slug ])}}"><img src="main/image/product/{{$new->image}}" alt="{{$new->image}}"></a>
                                        <div class="media-body">
                                            {{$new->name}}
                                        </div>
                                    </div>
                            </div>
                        @endforeach
                    </div>
                </div> <!-- best sellers widget -->
            </div>
        </div>
    </div> <!-- #content -->
</div> <!-- .container -->
@endsection
