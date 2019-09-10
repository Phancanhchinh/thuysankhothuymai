@extends('mid.layout.index')
@section('content')
<div class="inner-header">
    <div class="container">
        <div class="pull-left">
            <h6 class="inner-title">{{ trans('message.login') }}</h6>
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
                        <input type="email" name="txtEmail" id="email" required>
                    </div>
                    <div class="form-block">
                        <label for="password">{{ trans('message.password') }}*</label>
                        <input type="password" name="txtPass"  id="password" required>
                    </div>
                    <div class="form-block">
                        <button type="submit" class="btn btn-primary">{{ trans('message.login') }}</button>
                    </div>
                </div>
                <div class="col-sm-3"></div>
            </div>
        </form>
    </div> <!-- #content -->
    <div>
        <a class="btn btn-danger" href="facebook/login/facebook" >{{ trans('message.login')  }} facebook</a>
    </div>
</div> <!-- .container -->
@endsection
