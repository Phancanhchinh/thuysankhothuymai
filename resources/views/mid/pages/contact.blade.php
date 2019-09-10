@extends('mid.layout.index')
@section('content')
	{{-- content --}}
    <div class="inner-header">
		<div class="container">
			<div class="pull-left">
				<h6 class="inner-title">{{ trans('message.menu_contact') }}</h6>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	<div class="beta-map">

		<div class="abs-fullwidth beta-map wow flipInX"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3918.782054548272!2d106.63896141533445!3d10.827984061199565!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x317529708110ef11%3A0xa280b543d04778ff!2zNTQ0IFBo4bqhbSBWxINuIELhuqFjaCwgUGjGsOG7nW5nIDE1LCBHw7IgVuG6pXAsIEjhu5MgQ2jDrSBNaW5oLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1552034179519" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe></div>
	</div>
	<div class="container">
		<div id="content" class="space-top-none">

			<div class="space50">&nbsp;</div>
			<div class="row">
				<div class="col-sm-8">
					<h2>{{ trans('message.contact_form') }}</h2>
					<div class="space20">&nbsp;</div>
					<div class="space20">&nbsp;</div>
					<form action="#" method="post" class="contact-form">
						<div class="form-block">
							<input name="your-name" type="text" placeholder="{{ trans('message.fullname') }}">
						</div>
						<div class="form-block">
							<input name="your-email" type="email" placeholder="{{ trans('message.email') }}">
						</div>
						<div class="form-block">
							<textarea name="your-message" placeholder="{{ trans('message.mes') }}"></textarea>
						</div>
						<div class="form-block">
							<button type="submit" class="beta-btn primary">{{ trans('message.send') }} <i class="fa fa-chevron-right"></i></button>
						</div>
					</form>
				</div>
				<div class="col-sm-4">
					<h2>{{ trans('message.contact_info') }}</h2>
					<div class="space20">&nbsp;</div>

					<h6 class="contact-title">{{ trans('message.address') }}</h6>
					<p>
						544 Phạm Văn Bạch Phường 12 Quận Gò Vấp TP.HCM <br>
                    </p>
                <br/>
                    <h6 class="contact-title">{{ trans('message.phone') }}</h6>
                    <p>
                        039 822 5105 <br>
                    </p>
				</div>
			</div>
		</div> <!-- #content -->
	</div> <!-- .container -->
    {{-- content --}}
@endsection
