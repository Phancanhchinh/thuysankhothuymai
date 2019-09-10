@extends('mid.layout.index')
@section('content')
<div class="inner-header">
    <div class="container">
        <div class="pull-left">
            <h6 class="inner-title">{{ trans('message.menu_product') }} </h6>
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
                        <h4>{{ trans('message.all') }} </h4>
                        <div class="beta-products-details">
                            <p class="pull-left">{{ trans('message.product',['new_product'=> count($all_product)]) }}</p>
                            <div class="clearfix"></div>
                        </div>
                        <div class="row">
                                @foreach ($all_product as $all)
                                    <div class="col-sm-4">
                                        <div class="single-item">
                                            @if ($all->promotion_price > 0 || $all->promotion_price != null )
                                                <div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>
                                            @endif
                                            <div class="single-item-header">
                                                <a href="{{route('show_detail',['id'=>$all->id ,'slug'=>$all->slug])}}"><img height="250px" width="250px" src="main/image/product/{{$all->image}}" alt="{{$all->image}}"></a>
                                            </div>
                                            <div class="single-item-body">
                                                <p class="single-item-title">{{$all->name}}</p>
                                                <p class="single-item-price">
                                                    @if ($all->promotion_price != 0 || $all->promotion_price != null)
                                                        <span class="flash-del">{{number_format($all->unit_price)}} vnd</span>
                                                        <span class="flash-sale">{{number_format($all->promotion_price)}} vnd</span>
                                                    @else
                                                        <span>{{number_format($all->unit_price)}} vnd</span>
                                                    @endif
                                                </p>
                                            </div>
                                            <div class="single-item-caption">
                                                <a class="add-to-cart pull-left" href="{{route('show_order',['id'=> $all->id])}}"><i class="fa fa-shopping-cart"></i></a>
                                                <a class="beta-btn primary" href="{{route('show_detail',['id'=>$all->id ,'slug'=>$all->slug])}}">{{ trans('message.detail') }} <i class="fa fa-chevron-right"></i></a>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="row">{{$all_product}}</div>
                    </div> <!-- .beta-products-list -->
                    <div class="space50">&nbsp;</div>
                    </div> <!-- .beta-products-list -->
                </div>
            </div> <!-- end section with sidebar and main content -->


        </div> <!-- .main-content -->
    </div> <!-- #content -->
</div> <!-- .container -->
@endsection
