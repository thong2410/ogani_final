@extends('layouts.app')
@section('title', trans('main.contact'))
@section('content')
<div class="ogami-breadcrumb">
    <div class="container">
      <ul>
        <li> <a class="breadcrumb-link" href="{{ route('home') }}"> <i class="fas fa-home"></i>@lang('main.home')</a></li>
        <li> <a class="breadcrumb-link active" href="#">@lang('main.contact')</a></li>
      </ul>
    </div>
  </div>
  <div class="contact-us">
    <div class="container">
      <div class="feature map">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3833.8025459042856!2d108.16776031468427!3d16.075732988876904!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x314218e6e72e66f5%3A0x46619a0e2d55370a!2zMTM3IE5ndXnhu4VuIFRo4buLIFRo4bqtcCwgVGhhbmggS2jDqiBUw6J5LCBMacOqbiBDaGnhu4N1LCDEkMOgIE7hurVuZywgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1592911651694!5m2!1svi!2s" ></iframe> </script>
      </div>
      <div class="contact-method">
        <div class="row">
          <div class="col-12 col-md-4">
            <div class="method-block"><i class="icon_pin_alt"></i>
              <div class="method-block_text">
                <p>@lang('main.contact1.street')</p>
                <p>@lang('main.contact1.city')</p>
              </div>
            </div>
          </div>
          <div class="col-12 col-md-4">
            <div class="method-block"><i class="icon_mail_alt"></i>
              <div class="method-block_text">
                <p> <span>Hotline:</span> 65 11.188.888 </p>
                <p><span>Mail:</span> info.ogani@gmail.com</p>
              </div>
            </div>
          </div>
          <div class="col-12 col-md-4">
            <div class="method-block"><i class="icon_clock_alt"></i>
              <div class="method-block_text">
                <p>@lang('main.contact1.week')</p>
                <p>@lang('main.contact1.sunday')</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="leave-message">
        @if (session('success'))
                  <div class="alert alert-success mt-2 mb-2">
                    {{ session('success') }}
                  </div>
        @endif
        <h1 class="title">@lang('main.contact')</h1>
        <p>@lang('main.contact1.sub_text')</p>
        <form class="form-horizontal" method="POST" action="{{ route('contact') }}">
            {{ csrf_field() }}
          <div class="row">
            <div class="col-12 col-md-6">
              <input class="no-round-input" required type="text" name="name" placeholder="@lang("main.fullname_text")" >
            </div>
            <div class="col-12 col-md-6">
              <input class="no-round-input" required type="email" name="email" placeholder="@lang('main.email_text')">
            </div>
            <div class="col-12">
              <textarea class="textarea-form" required name="note" cols="30" rows="10" placeholder="@lang('main.contact1.content_text')"></textarea>
            </div>
           
            <div class="account-function col-12 mt-4">
                <button class="pink no-round-btn" type="submit">@lang('main.contact1.submit')</button>
         </div>
          </div>
        </form>
      </div>
    </div>
  </div>         
       
@endsection
