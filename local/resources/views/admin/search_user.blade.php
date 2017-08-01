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
                    <li><a href="{{url('search_user')}}" class="active"><i class="fa fa-user"></i> ค้นหา User</a></li>
                  </div>
                  <div class="col-sm-3">
                    <li><a href="{{url('admin')}}"><i class="fa fa-crosshairs"></i> ตรวจสอบการแบน</a></li>
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
                      <li><a href="{{url('search_user')}}" class="active" ><i class="fa fa-user"></i> ค้นหา User</a></li>
                    </div>
                    <div class="col-sm-4">
                      <li><a href="{{url('admin')}}"><i class="fa fa-crosshairs"></i> ตรวจสอบการแบน</a></li>
                    </div>
                @endif
              @else
                @if($user->provider == "Normal")
                <div class="col-md-12">
                  <li><a href="{{url('buy_user')}}" ><i class="fa fa-shopping-cart"></i>สถานะร้าน</a></li>

                  <li><a href="{{url('search_user')}}" class="active" ><i class="fa fa-user"></i> ค้นหา User</a></li>

                  <li><a href="{{url('admin')}}"><i class="fa fa-crosshairs"></i> ตรวจสอบการแบน</a></li>

                  <li><a href="{{url('histtory_sell')}}"><i class="fa fa-star"></i> ประวัติการซื้อ</a></li>

                  <li><a href="{{url('histtory_buy')}}"><i class="fa fa-star"></i> ประวัติการขาย</a></li>

                  <li><a href="{{url('re_password')}}">
                  <span class="glyphicon glyphicon-wrench" aria-hidden="true"></span>
                    เปลี่ยนรหัส
                  </a></li>
                </div>
                @else
                <div class="col-md-2">
                  <li><a href="{{url('buy_user')}}"><i class="fa fa-shopping-cart"></i>สถานะร้าน</a></li>
                </div>
                <div class="col-md-2">
                  <li><a href="{{url('search_user')}}" class="active"><i class="fa fa-user"></i> ค้นหา User</a></li>
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
            <form class="form-inline" action = "{{url('search_user')}}" method = "get">
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
<div class="container">
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
            <td class="description">ระดับ</td>
            <td class="description">ติดต่อ</td>
            <td class="description">สถานะ User</td>
            <td class="description">Action</td>
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
            <p>  @if($row->status_ban == 1)
              แบน
              @else
              ปกติ
              @endif</p>
            </td>
            <td class="tableme">
              @if($row->id != $user->id )
                @if($user->rank == 'Admin')
                  @if($row->rank == 'User' || $row->rank == 'Mod')
                    @if($row->status_ban == 1)
                      <form method="get" action="{{ url('un_ban_post/'.$row->id) }}" >
                        {{ method_field('PUT') }}
                        {{ csrf_field()}}
                        @if($row->status_ban == 1 && $row->id != $user->id)
                          <button type="submit" class="btn btn-success" name="action_block">ปลดแบน</button>
                        @endif
                      </form>
                    @else
                        <form method="get" action="{{ url('admin/'.$row->id.'/edit')}}" >
                          {{ method_field('PUT') }}
                          {{ csrf_field()}}
                          @if($row->status_ban == 0 && $row->id != $user->id)
                            <button type="submit" class="btn btn-danger" name="action_block">แบน</button>
                          @endif
                        </form>
                    @endif
                  @endif
                  @elseif($user->rank == 'Mod')
                    @if($row->rank == 'User')
                      @if($row->status_ban == 1)
                        <form method="get" action="{{ url('un_ban_post/'.$row->id) }}" >
                          {{ method_field('PUT') }}
                          {{ csrf_field()}}
                          @if($row->status_ban == 1 && $row->id != $user->id)
                            <button type="submit" class="btn btn-success" name="action_block">ปลดแบน</button>
                          @endif
                        </form>
                      @else
                          <form method="get" action="{{ url('admin/'.$row->id.'/edit')}}" >
                            {{ method_field('PUT') }}
                            {{ csrf_field()}}
                            @if($row->status_ban == 0 && $row->id != $user->id)
                              <button type="submit" class="btn btn-danger" name="action_block">แบน</button>
                            @endif
                          </form>
                      @endif
                    @endif
                  @endif
                @endif
              <br>
              @if($row->id != $user->id )
                @if($user->rank == 'Admin')
                  @if($row->rank == 'User' || $row->rank == 'Mod')
                    <form method="get" action="{{ url('addrank/'.$row->id)}}" >
                    <div class="form-inline">
                      <select  name="rank" type="select" value="{{$row->rank or ''}}" id="rank" class="form-control">
                        <option value = null>เลือก</option>
                        <option value = "Mod">Mod</option>
                        <option value = "User">User</option>
                      </select >
                      <button type="submit" class="btn btn-primary" name="action_block">Save</button>
                    </div>
                    </form>
                  @endif
                @elseif($user->rank == 'Mod')
                  @if($row->rank == 'User')
                    <form method="get" action="{{ url('addrank/'.$row->id)}}" >
                    <div class="form-inline">
                      <select  name="rank" type="select" value="{{$row->rank  or ''}}" id="rank" class="form-control">
                        <option value = null>เลือก</option>
                        <option value = "Mod">Mod</option>
                        <option value = "User">User</option>
                      </select >
                      <button type="submit" class="btn btn-primary" name="action_block">Save</button>
                    </div>
                    </form>
                  @endif
                @endif
              @endif
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</section> <!--/#cart_items-->
</div>
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

@endsection
</body>
