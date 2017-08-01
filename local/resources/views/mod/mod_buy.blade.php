@extends('layouts.table_statuspost')

@section('head')
<div class="container" >
    <div class="buttons">
      <a class="btn btn-primary" href="{{url('buy_user')}}"> สถานะร้าน </a>
      <a class="btn btn-primary" href="{{url('search_user')}}"> ค้นหา User </a>
      <a class="btn btn-primary" href="{{url('histtory_buy')}}"> ประวัติการขาย </a>
      <a class="btn btn-primary" href="{{url('admin')}}"> ตรวจสอบการแบน </a>
      @if($user->provider == "Normal")
      <a class="btn btn-primary" href="{{url('re_password')}}"> เปลี่ยนรหัส </a>
      @endif
    </div>
</div>
@section('dow')
<div class="container" >
  <div class="form-inline ">
    <a class="btn btn-primary" href="{{url('user/create')}}"> Create </a>
  </div>
</div>
@stop
@endsection
