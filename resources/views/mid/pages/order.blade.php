
@extends('mid.layout.index')
@section('content')

<div class="inner-header">
		<div class="container">
			<div class="pull-left">
				<h6 class="inner-title">{{ trans('message.order') }}</h6>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>

	<div class="container">
		<div id="content">

			<form action="" method="post" class="beta-form-checkout">
				<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
				<div class="row">
					<div class="col-sm-6">
						@if(count($errors) > 0)
							<div class="alert alert-danger">
								@foreach ($errors->all() as $err)
									{{$err}} <br/>
								@endforeach
							</div>
						@endif
						<div class="space20">&nbsp;</div>

						<div class="form-block">
							<label for="name">{{ trans('message.fullname') }}<span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name"
                            @if (isset($user))
                                value="{{$user->full_name}}"
                            @endif
                            required>
						</div>
						<div class="form-block">
							<label>{{ trans('message.gender') }} </label>
							<input id="gender" type="radio" class="input-radio" name="gender" value="nam" checked="checked" style="width: 10%"><span style="margin-right: 10%">{{ trans('message.men') }}</span>
							<input id="gender" type="radio" class="input-radio" name="gender" value="nữ" style="width: 10%"><span>{{ trans('message.women') }}</span>
						</div>

						<div class="form-block">
							<label for="email">{{ trans('message.email') }}<span class="text-danger">*</span></label>
                            <input type="email" name="email" id="email"
                            @if (isset($user))
                                value="{{$user->email}}"
                            @endif
                            required>
						</div>

						<div class="form-block">
							<label for="adress">{{ trans('message.address') }}<span class="text-danger">*</span></label>
                            <input type="text" name="address" id="address"
                            @if (isset($user))
                                value="{{$user->address}}"
                            @endif
                            required>
						</div>


						<div class="form-block">
							<label for="phone">{{ trans('message.phone') }}<span class="text-danger">*</span></label>
                            <input type="text" name="phone_number" id="phone_number"
                            @if (isset($user))
                                value="{{$user->phone}}"
                            @endif
                            required>
						</div>

						<div class="form-block">
							<label for="notes">{{ trans('message.mes') }}<span class="text-danger">*</span></label>
							<textarea name="note" id="note"></textarea>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="your-order">
							<div class="your-order-head"><h5>{{ trans('message.yourOrder') }}</h5></div>
							<div class="your-order-body" style="padding: 0px 10px">
								<div class="your-order-item">
									<div>
									<!--  one item	 -->
									@if (Session::has('cart'))
										@foreach($cart['default'] as $key => $data)
											<div class="media">
												<img width="25%" alt="" class="pull-left" src="main/image/product/{{$data->options[0]->image}}">
												<div class="media-body">
													<p class="font-large">{{$data->name}}</p>
													<span class="text-danger your-order-info">{{ trans('message.quantity') }} :
                                                            {{-- @if(count($errors) > 0)
                                                                <div class="alert alert-danger">
                                                                    @foreach ($errors->all() as $err)
                                                                        {{$err}} <br/>
                                                                    @endforeach
                                                                </div>
                                                            @endif --}}
                                                        <input onblur="updateCart('{{$data->rowId}}')" type="text" name="txtUpdate" id="sl_{{$data->rowId}}" value="{{$data->qty}}"/>
                                                    </span>
												</div>
											</div>
										@endforeach
									@endif
									<!-- end one item -->
									</div>
									<div class="clearfix"></div>
								</div>
								<div class="your-order-item">
									<div class="pull-left"><p class="your-order-f18">{{ trans('message.total') }}:</p></div>
									<div class="pull-right"><h5 class="color-black">{{$totalPrice}} VND</h5></div>
									<div class="clearfix"></div>
								</div>
							</div>
							<div class="your-order-head"><h5>{{ trans('message.payment') }}</h5></div>

							<div class="your-order-body">
								<ul class="payment_methods methods">
									<li class="payment_method_bacs">
										<input id="payment_method_bacs" type="radio" class="input-radio" name="payment_method" value="COD" checked="checked" data-order_button_text="">
										<label for="payment_method_bacs">{{ trans('message.cod') }} </label>
										<div class="payment_box payment_method_bacs" style="display: block;">
                                            {{ trans('message.mesCod') }}
										</div>
									</li>

									<li class="payment_method_cheque">
										<input id="payment_method_cheque" type="radio" class="input-radio" name="payment_method" value="ATM" data-order_button_text="">
										<label for="payment_method_cheque">{{ trans('message.atm') }}</label>
										<div class="payment_box payment_method_cheque" style="display: none;">
											Chuyển tiền đến tài khoản sau:
											<br>- Số tài khoản: 123 456 789
											<br>- Chủ TK: Lê Thị Thùy Mai
											<br>- Ngân hàng ACB Chi nhánh Gò Vấp TPHCM
										</div>
									</li>

								</ul>
							</div>
							<div class="center">
                                    <button type="submit"
                                    @if($totalPrice == 0)
                                        {{"disabled "}}
                                    @endif
                                    class="btn btn-primary">{{ trans('message.ok') }}</button>
										&emsp;
									<button type="reset" class="btn btn-primary">Reset</button>
							</div>

						</div> <!-- .your-order -->
					</div>
				</div>
			</form>
		</div> <!-- #content -->
	</div> <!-- .container -->
@endsection
@section('script')
    <script>
        function updateCart(id){
            let sl = $("#sl_"+ id).val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
            $.ajax({
                url:"dat-hang-update",
                method:"POST",
                data:{
                    id : id,
                    sl : sl
                    },
                success : function(data){
                    if(data){
                        window.location = "pay";
                    }
                },
                error : function(data){
                    if(data){
                        window.location = "/";
                    }
                }
            })
        }
    </script>
@endsection







