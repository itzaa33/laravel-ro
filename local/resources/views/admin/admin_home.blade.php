@extends('layouts.app')
@section('content')
  <body class="bodyBG-home">
    <div class="container" align="center">
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
        <a href="{{url('admin_approve')}}"><img src="{{asset('/BG/'.'Admin_button_home.png')}}" class="image" ></a>
        </div>
        <div class="col-xs-12 col-sm-5 col-md-5 col-lg-5">
        <a  href="{{url('select_type_item')}}"><img src="{{asset('/BG/'.'Sell_button_home.png')}}"class="image"></a>
        </div>
    </div>
  </body>

@endsection
