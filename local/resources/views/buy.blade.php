@extends('layouts.table_statuspost')

@section('head')

<head>
  <div class="header-middle"><!--header-middle-->
    <div class="container">
      <div class="row">
          <div class="shop-menu">
            <ul class="nav">
              @if($id_user->rank == "Mod")
                @if($id_user->provider == "Normal")
                <div class="col-md-12">
                    <li><a href="{{url('buy_user')}}" class="active"><i class="fa fa-shopping-cart"></i>สถานะร้าน</a></li>


                    <li><a href="{{url('search_user')}}"><i class="fa fa-user"></i> ค้นหา User</a></li>


                    <li><a href="{{url('admin')}}" ><i class="fa fa-crosshairs"></i> ตรวจสอบการแบน</a></li>


                    <li><a href="{{url('histtory_sell')}}"><i class="fa fa-star"></i> ประวัติการซื้อ</a></li>


                    <li><a href="{{url('histtory_buy')}}"><i class="fa fa-star"></i> ประวัติการขาย</a></li>


                    <li><a href="{{url('re_password')}}">
                    <span class="glyphicon glyphicon-wrench" aria-hidden="true"></span>
                      เปลี่ยนรหัส
                    </a></li>
                  </div>
                  @else
                  <div class="col-md-2">
                    <li><a href="{{url('buy_user')}}" class="active"><i class="fa fa-shopping-cart"></i>สถานะร้าน</a></li>
                  </div>
                  <div class="col-md-2">
                    <li><a href="{{url('search_user')}}" ><i class="fa fa-user"></i> ค้นหา User</a></li>
                  </div>
                  <div class="col-md-3">
                    <li><a href="{{url('admin')}}"><i class="fa fa-crosshairs"></i> ตรวจสอบการแบน</a></li>
                  </div>
                  <div class="col-md-3">
                    <li><a href="{{url('histtory_sell')}}"><i class="fa fa-star"></i> ประวัติการซื้อ</a></li>
                  </div>
                  <div class="col-md-2">
                    <li><a href="{{url('histtory_buy')}}"><i class="fa fa-star"></i> ประวัติการขาย</a></li>
                  </div>
                  @endif
              @else
                @if($id_user->provider == "Normal")
                <div class="col-md-3">
                  <li><a href="{{url('buy_user')}}" class="active" ><i class="fa fa-shopping-cart"></i>สถานะร้าน</a></li>
                </div>
                <div class="col-md-3">
                  <li><a href="{{url('histtory_sell')}}"><i class="fa fa-star"></i> ประวัติการซื้อ</a></li>
                </div>
                <div class="col-md-3">
                  <li><a href="{{url('histtory_buy')}}"><i class="fa fa-star"></i> ประวัติการขาย</a></li>
                </div>
                <div class="col-md-3">
                  <li><a href="{{url('re_password')}}">
                  <span class="glyphicon glyphicon-wrench" aria-hidden="true"></span>
                    เปลี่ยนรหัส
                  </a></li>
                </div>
                @else
                <div class="col-sm-4">
                  <li><a href="{{url('buy_user')}}" ><i class="fa fa-shopping-cart"></i>สถานะร้าน</a></li>
                </div>
                <div class="col-md-4">
                  <li><a href="{{url('histtory_sell')}}"><i class="fa fa-star"></i> ประวัติการซื้อ</a></li>
                </div>
                <div class="col-sm-4">
                  <li><a href="{{url('histtory_buy')}}"><i class="fa fa-star"></i> ประวัติการขาย</a></li>
                </div>
                @endif
              @endif
            </ul>
          </div>
        </div>
      </div>
    </div>
  </head>



@section('dow')
@if($count > 9)
<div class="container">
  <div class="navbar navbar-inverse ">
  <div class="row" align="center" style="margin: -32px;">
    <ul class="pagination">
      {{$table->links()}}
    </ul>
  </div>
</div>
</div>
@endif
@stop
@endsection
</body>
