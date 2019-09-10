@extends('mid.layout.index')
@section('content')
    <section class="bg-gray">
            <div class="inner-header">
                <div class="container">
                    <div class="pull-left">
                        <h6 class="inner-title">Thanks</h6>
                    </div>
                    <div class="pull-right">
                        <div class="beta-breadcrumb font-large">
                            <a href="#">Pages</a> / <span>Page 202</span>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>

            <div class="container">
                <div id="content" class="space-top-none space-bottom-none">
                    <div class="abs-fullwidth bg-gray">
                        <div class="space100">&nbsp;</div>
                        <div class="space80">&nbsp;</div>
                        <div class="container text-center">
                            <h2 class="text-danger">
                                    @if (Session::has('msg'))
                                        {{Session::get('msg')}}
                                    @else
                                        Error
                                    @endif
                            </h2>
                            <a class="bg-success h4" href="{{route('show_index')}}">Về Trang Chủ</a>
                            <div class="space40">&nbsp;</div>
                            <img src="assets/dest/images/404.jpg" alt="">
                            <div class="space30">&nbsp;</div>
                        </div>
                        <div class="space100">&nbsp;</div>
                        <div class="space30">&nbsp;</div>
                    </div>
                </div> <!-- #content -->
            </div> <!-- .container -->
    </section>
@endsection
