@extends('mid.layout.index')
@section('content')
<div class="inner-header">
    <div class="container">
        <div class="pull-left">
            <h6 class="inner-title">Tìm Sản phẩm</h6>
        </div>
        <div class="pull-right">
            <div class="beta-breadcrumb font-large">
                <a href="index.html">Home</a> / <span class="text-danger">Tìm Sản phẩm</span>
            </div>
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
                            <li><a href="{{route('show_typeproduct',['id'=> $type->id])}}">{{$type->name}}</a></li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-sm-9">
                    <div class="beta-products-list">
                        <h4> Sản Phẩm </h4>
                        <div class="beta-products-details">
                            <p class="pull-left">có {{count($search_product)}} <span class="text-danger">sản phẩm</span></p>
                            <div class="clearfix"></div>
                        </div>
                        <div class="row">
                                @foreach ($search_product as $search)
                                    <div class="col-sm-4">
                                        <div class="single-item">
                                            @if ($search->promotion_price > 0 || $search->promotion_price != null )
                                                <div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>
                                            @endif
                                            <div class="single-item-header">
                                                <a href="{{route('show_detail',['id'=>$search->id])}}"><img height="250px" width="250px" src="main/image/product/{{$search->image}}" alt="{{$search->image}}"></a>
                                            </div>
                                            <div class="single-item-body">
                                                <p class="single-item-title">{{$search->name}}</p>
                                                <p class="single-item-price">
                                                    @if ($search->promotion_price != 0 || $search->promotion_price != null)
                                                        <span class="flash-del">{{number_format($search->unit_price)}} vnd</span>
                                                        <span class="flash-sale">{{number_format($search->promotion_price)}} vnd</span>
                                                    @else
                                                        <span>{{number_format($search->unit_price)}} vnd</span>
                                                    @endif
                                                </p>
                                            </div>
                                            <div class="single-item-caption">
                                                <a class="add-to-cart pull-left" href="{{route('show_order',['id'=> $search->id])}}"><i class="fa fa-shopping-cart"></i></a>
                                                <a class="beta-btn primary" href="{{route('show_detail',['id'=>$search->id])}}">Chi tiết <i class="fa fa-chevron-right"></i></a>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="row">{{$search_product}}</div>
                    </div> <!-- .beta-products-list -->
                    <div class="space50">&nbsp;</div>
                    </div> <!-- .beta-products-list -->
                </div>
            </div> <!-- end section with sidebar and main content -->


        </div> <!-- .main-content -->
    </div> <!-- #content -->
</div> <!-- .container -->
@endsection
