@extends('mid.layout.index')
@section('content')
    <div class="inner-header">
        <div class="container">
            <div class="pull-left">
                <h6 class="inner-title">{{ trans('message.register') }}</h6>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="container">
            @if(count($errors) > 0)
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $err)
                        {{$err}} <br/>
                    @endforeach
                </div>
            @endif
        <div id="content">
            <form action="" method="post" class="beta-form-checkout">
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                <div class="row">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-6">
                        <div class="space20">&nbsp;</div>
                        <div class="form-block">
                            <label for="email">{{ trans('message.email') }}*</label>
                            <input type="email" name="email" id="email" required>
                        </div>
                        <div class="form-block">
                            <label for="full_name">{{ trans('message.fullname') }}*</label>
                            <input type="text" name="full_name" id="full_name" required>
                        </div>
                        <div class="form-block">
                            <label for="adress">{{ trans('message.address') }}*</label>
                            <input type="text" name="address" id="adress"  required>
                        </div>
                        <div class="form-block">
                            <label for="phone">{{ trans('message.phone') }}*</label>
                            <input type="text" name="phone" id="phone" required>
                        </div>
                        <div class="form-block">
                            <label>{{ trans('message.password') }}*</label>
                            <input type="password" name="password" required>
                        </div>
                        <div class="form-block">
                            <label>{{ trans('message.repassword') }}*</label>
                            <input type="password" name="rePassword" required>
                        </div>
                        <div class="form-block">
                            <button type="submit" class="btn btn-primary">{{ trans('message.register') }}</button>
                        </div>
                    </div>
                    <div class="col-sm-3"></div>
                </div>
            </form>
        </div> <!-- #content -->
    </div> <!-- .container -->
@endsection
