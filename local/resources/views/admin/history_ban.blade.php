@extends('layouts.app')
<body class="buy-page">
@section('content')
<head>
  <div class="header-middle"><!--header-middle-->
    <div class="container">
      <div class="row">
          <div class="shop-menu">
            <ul class="nav">

              @if($user->rank == "Admin")
                @if($user->provider == "Normal")
                  <div class="col-sm-3">
                    <li><a href="{{url('admin_approve')}}" ><i class="fa fa-shopping-cart"></i>อนุมัติการขาย</a></li>
                  </div>
                  <div class="col-sm-3">
                    <li><a href="{{url('search_user')}}" ><i class="fa fa-user"></i> ค้นหา User</a></li>
                  </div>
                  <div class="col-sm-3">
                    <li><a href="{{url('admin')}}" class="active"><i class="fa fa-crosshairs"></i> ตรวจสอบการแบน</a></li>
                  </div>
                  <div class="col-sm-3">
                    <li><a href="{{url('re_password')}}">
                    <span class="glyphicon glyphicon-wrench" aria-hidden="true"></span>
                      เปลี่ยนรหัส
                    </a></li>
                  </div>
                  @else
                    <div class="col-sm-4">
                      <li><a href="{{url('admin_approve')}}" ><i class="fa fa-shopping-cart"></i>อนุมัติการขาย</a></li>
                    </div>
                    <div class="col-sm-4">
                      <li><a href="{{url('search_user')}}"><i class="fa fa-user"></i> ค้นหา User</a></li>
                    </div>
                    <div class="col-sm-4">
                      <li><a href="{{url('admin')}}" class="active"><i class="fa fa-crosshairs"></i> ตรวจสอบการแบน</a></li>
                    </div>
                @endif
              @else
                @if($user->provider == "Normal")
                <div class="col-md-12">
                  <li><a href="{{url('buy_user')}}" ><i class="fa fa-shopping-cart"></i>สถานะร้าน</a></li>

                  <li><a href="{{url('search_user')}}"><i class="fa fa-user"></i> ค้นหา User</a></li>

                  <li><a href="{{url('admin')}}" class="active"><i class="fa fa-crosshairs"></i> ตรวจสอบการแบน</a></li>

                  <li><a href="{{url('histtory_sell')}}"><i class="fa fa-star"></i> ประวัติการซื้อ</a></li>

                  <li><a href="{{url('histtory_buy')}}"><i class="fa fa-star"></i> ประวัติการขาย</a></li>

                  <li><a href="{{url('re_password')}}">
                  <span class="glyphicon glyphicon-wrench" aria-hidden="true"></span>
                    เปลี่ยนรหัส
                  </a></li>
                </div>
                @else
                <div class="col-md-2">
                  <li><a href="{{url('buy_user')}}" ><i class="fa fa-shopping-cart"></i>สถานะร้าน</a></li>
                </div>
                <div class="col-md-2">
                  <li><a href="{{url('search_user')}}" ><i class="fa fa-user"></i> ค้นหา User</a></li>
                </div>
                <div class="col-md-3">
                  <li><a href="{{url('admin')}}"class="active"><i class="fa fa-crosshairs"></i> ตรวจสอบการแบน</a></li>
                </div>
                <div class="col-md-3">
                  <li><a href="{{url('histtory_sell')}}"><i class="fa fa-star"></i> ประวัติการซื้อ</a></li>
                </div>
                <div class="col-md-2">
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


<div class="container">
    <div class="navbar navbar-inverse ">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#search-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>


        <div class="mainmenu pull-left">
          <ul class="nav navbar-nav collapse navbar-collapse" id="search-collapse">
            <form class="form-inline" action = "{{route('admin.index')}}" method = "get">
                {{ csrf_field()}}

                    <select  name="type" type="select" id="type" class="form-control">
                      <option value = null>เลือก</option>
                      <option value = "name">ชื่อ</option>
                      <option value = "URL_FaceBook">URL FaceBook</option>
                      <option value = "email">E-mail</option>
                      <option value = "title">ชื่อร้าน</option>
                    </select >

                    <input type="text" name = "value" id = "value" placeholder="Search" class="form-control">
                    <button type="submit" name = "submit" value="Search" class="btn btn-primary">Search</button>
            </form>
          </ul>
        </div>
      </div>
    </div>
</div>


<!--/header-bottom-->
<section id="cart_items"><!--/#cart_items-->
  <div class="container">
    <div class="table-responsive cart_info">
      <table class="table table-condensed">
        <thead>
          <tr class="cart_menu">
            <td class="description">ID User</td>
            <td class="description">ชื่อ</td>
            <td class="description">E-mail</td>
            <td class="description">Provider</td>
            <td class="description">ระดับผู้ถูกแบน</td>
            <td class="description">ติดต่อ</td>
            <td class="description">คำสั่ง</td>
            <td class="description">ผู้แบน</td>
            <td class="description">ระดับผู้แบน</td>
            <td class="description">แบนเนื่องจาก</td>
          </tr>
        </thead>
        <tbody>
          @foreach($table as $row)
          <tr>
            <td class="tableme">
              <p>{{$row->id}}</p>
            </td>
            <td class="tableme">
              <p>{{$row->name}}</p>
            </td>
            <td class="tableme">
              <p>{{$row->email}}</p>
            </td>
            <td class="tableme">
            <p>{{$row->provider}}</p>
            </td>
            <td class="tableme">
            <p>{{$row->rank}}</p>
            </td>
            <td class="tableme">
              <a href="{{ URL::to($row->URL_FaceBook) }}" target="_blank"><p><font color="#f8fe0f"><U>ติดต่อ </U></font></p></a>
            </td>
            <td class="tableme">
              <p>@if($row->command == 1)
                แบน
                @else
                ปลดแบน
                @endif</p>
            </td>
            <td class="tableme">
            <p>{{$row->name_admin}}</p>
            </td>
            <td class="tableme">
            <p>{{$row->rank_admin}}</p>
            </td>
            <td class="tableme">
              <p>@if($row->description == 1)
              โกงเงินหรือสินค้าของผู้อื่น
              @elseif($row->description == 2)
              จงใจสร้างบล็อคที่คล้ายๆกันหลายๆบล็อค
              @elseif($row->description == 3)
              ใส่ร้ายผู้อื่น
              @elseif($row->description == 4)
              ไม่มีของที่ขายในบล็อคที่สร้าง
              @else
              -
              @endif</p>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</section> <!--/#cart_items-->

@if($count > 20)
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
@endsection
</body>
