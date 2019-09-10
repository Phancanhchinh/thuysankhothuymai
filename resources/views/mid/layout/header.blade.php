<!doctype html>
<html lang="{{app()->getLocale()}}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Thủy Sản Khô Thùy Mai </title>
    <script data-pace-options='{ "ghostTime": 2000 }' src="{{asset('main/assets/dest/pace/pace.js')}}"></script>
    <link href="{{asset('main/assets/dest/pace/themes/red/pace-theme-minimal.css')}}" rel="stylesheet" />
    <link href="{{asset('main/assets/dest/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin/img/fish.png')}}" rel="shortcut icon">
    <link href="{{asset('main/assets/dest/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('main/assets/dest/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('main/assets/dest/rs-plugin/css/settings.css')}}" rel="stylesheet">
    <link href="{{asset('main/assets/dest/rs-plugin/css/responsive.css')}}" rel="stylesheet">
    <link href="{{asset('main/assets/dest/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('main/assets/dest/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('main/assets/dest/css/astyle.css')}}" rel="stylesheet">
    <base href="{{asset('')}}">
</head>
<body>
	<div id="header">
		<div class="header-top">
			<div class="container">
				<div class="pull-left auto-width-left">
					<ul class="top-menu menu-beta l-inline">
						<li><a><i class="fa fa-home"></i> 544 Phạm Văn Bạch Phường 12 Gò Vấp TPHCM</a></li>
						<li><a><i class="fa fa-phone"></i> 039 822 5105</a></li>
					</ul>
				</div>
				<div class="pull-right auto-width-right">
					<ul class="top-details menu-beta l-inline">

						@if (Auth::check())
							<li><a><i class="fa fa-user"></i>{{Auth::user()->full_name}}</a></li>
							<li><a href="{{route('show_logout')}}">{{ trans('message.logout') }}</a></li>
						@else
                            <li><a><i class="fa fa-user"></i>{{ trans('message.account') }}</a></li>
							<li><a href="{{route('show_signup')}}">{{ trans('message.register') }}</a></li>
							<li><a href="{{route('show_login')}}">{{ trans('message.login') }}</a></li>
						@endif
                    </ul>
				</div>
				<div class="clearfix"></div>
			</div> <!-- .container -->
		</div> <!-- .header-top -->
		<div class="header-body">
			<div class="container beta-relative">
				<div class="pull-left">
					<a href="{{route('show_index')}}" id="logo">
                        <img style="with:250px;" src="main/assets/dest/images/logo2.png" src="logo" />
					</a>
				</div>
				<div class="pull-right beta-components space-left ov">
					<div class="space10">&nbsp;</div>
					<div class="beta-comp">
						<form role="search" method="get" id="searchform" action="{{route('show_search')}}">
							<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
							<input type="text" name="search" id="search" placeholder="{{ trans('message.search') }}" />
							<button class="fa fa-search" type="submit" id="searchsubmit"></button>
						</form>
					</div>
					<div class="beta-comp">
							<div class="cart">
								<div class="beta-select"><i class="fa fa-shopping-cart"></i> {{ trans('message.cart') }} (
										@if (Session::has('cart'))
                                            {{$countItem}}
                                        @else
                                            {{0}}
                                        @endif
                                            ) <i class="fa fa-chevron-down"></i>
                                </div>
								@if(Session::has('cart'))
									<div class="beta-dropdown cart-body">
                                        @if(isset($cart['default']))
                                            @foreach($cart['default'] as $data)
                                                <div class="cart-item">
                                                    <a class="cart-item-delete" href="{{route('show_delete',['id' => $data->rowId ])}}"><i class="fa fa-times"></i></a>
                                                    <div class="media">
                                                        <a class="pull-left"><img src="main/image/product/{{$data->options[0]->image}}"></a>
                                                        <div class="media-body">
                                                            <span class="cart-item-title">{{$data->name}}</span>
                                                            <span class="cart-item-amount">{{$data->qty}}*<span>
                                                                @if($data->price)
                                                                    {{number_format($data->price,0)}} VND
                                                                @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                        @if(isset($countItem) && $countItem != 0)
                                            <div class="cart-caption">
                                                <div class="cart-total text-right">{{ trans('message.total') }}: <span class="cart-total-value">{{$totalPrice}} VND</span></div>
                                                <div class="clearfix"></div>
                                                <div class="center">
                                                    <div class="space10">&nbsp;</div>
                                                    <a href="{{route('show_pay')}}" class="beta-btn primary text-center">{{ trans('message.pay') }}<i class="fa fa-chevron-right"></i></a>
                                                    <a href="{{route('show_deleteAll')}}" class="beta-btn primary text-center">{{ trans('message.delete') }}<i class="fa fa-chevron-right"></i></a>
                                                </div>
                                            </div>
                                        @endif
								</div>
								@endif
							</div> <!-- .cart -->
                    </div>
				</div>
                <div class="clearfix"></div>

                <div class="pull-right">
                        <a href="{{ route('user.change-language','en') }}">
                            <img width="50px" height="30px" src="admin/img/en.png" src="flag en"/>
                        </a>
                        <a href="{{ route('user.change-language','vi') }}">
                            <img width="50px" height="30px" src="admin/img/vn.png" src="flag vn"/>
                        </a>
                </div>

                {{-- <div class="pull-right">
                        <a href="{{route(\Illuminate\Support\Facades\Route::currentRouteName(),['vi',$id])}}">
                            <img width="50px" height="30px" src="admin/img/vn.png" src="flag vn"/>
                        </a>
                        <a href="{{route(\Illuminate\Support\Facades\Route::currentRouteName(),['en',$id])}}">
                            <img width="50px" height="30px" src="admin/img/en.png" src="flag en"/>
                        </a>
                </div> --}}



			</div> <!-- .container -->
		</div> <!-- .header-body -->
		<div class="header-bottom" style="background-color: #0277b8;">
			<div class="container">
				<div class="visible-xs clearfix"></div>
				<nav class="main-menu">
					<ul class="l-inline ov">
						<li><a href="{{route('show_index')}}">{{ trans('message.menu_home') }}</a></li>
                            <li><a href="{{route('show_product')}}">{{ trans('message.menu_product') }}</a>
                                <ul class="sub-menu">
                                    @foreach ($type_product as $type)
                                        <li><a href="{{route('show_typeproduct', ['id' => $type->id,'slug' => $type->slug])}}">{{$type->name}}</a></li>
                                    @endforeach
                                </ul>
                            </li>
						<li><a href="{{route('show_introduce')}}">{{ trans('message.menu_introduce') }}</a></li>
						<li><a href="{{route('show_contact')}}">{{ trans('message.menu_contact') }}</a></li>
					</ul>
					<div class="clearfix"></div>
				</nav>
			</div> <!-- .container -->
		</div> <!-- .header-bottom -->
	</div> <!-- #header -->
