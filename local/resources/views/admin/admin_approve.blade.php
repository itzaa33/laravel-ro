@extends('layouts.app')

@section('content')
<body class="buy-page">
  <div class="header-middle"><!--header-middle-->
    <div class="container">
      <div class="row">
          <div class="shop-menu">
            <ul class="nav">
              <div class="col-sm-3">
                <li><a href="{{url('admin_approve')}}" class="active"><i class="fa fa-shopping-cart"></i>อนุมัติการขาย</a></li>
              </div>
              <div class="col-sm-3">
                <li><a href="{{url('search_user')}}"><i class="fa fa-user"></i> ค้นหา User</a></li>
                </div>
              <div class="col-sm-3">
                <li><a href="{{url('admin')}}"><i class="fa fa-crosshairs"></i> ตรวจสอบการแบน</a></li>
                </div>
              <div class="col-sm-3">
                @if($user->provider == "Normal")
                <li><a href="{{url('re_password')}}">
                <span class="glyphicon glyphicon-wrench" aria-hidden="true"></span>
                  เปลี่ยนรหัส
                </a></li>
                @endif
                </div>
          </ul>
        </div>
    </div>
  </div>
</div>


  <div class="col-sm-12 padding-right">
  <div class="container">
  <div class="row">
    <div class="features_items"><!--features_items-->
      @foreach($table as $row)
      <div class="col-sm-4">
        <div class="product-image-wrapper">
          <div class="single-products">
            <h4><font color="#0cec49">{{$row->title}}</font></h4>
            <div class="productinfo text-center">
              <div class="form-group">
              <img src="{{asset('/local/public/images/'.$row->image)}}" alt="" id ="{{$row->id}}" onClick="show('{{$row->id}}')">

              <div class ="rank">ระดับ: {{$row->rank}}</div>

              @if($row->upgrade > 0)
              <div class ="upgrate">
                 อัพเกรต: +{{$row->upgrade}}
             </div>
            @endif

            </div>
              <h2>ราคา: {{$row->price}}
                    @if($row->currency == 1)
                    Z
                    @elseif($row->currency == 2)
                    B
                    @endif</h2>
              <p><font color="#1ed8e8">ชื่อ: {{$row->name}}</font></p>

              <div class="form-group">
              <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
              <p><font color="#ff0000">
                ประเภท:
              @if($row->category == 1)
                  Weapon
              @elseif($row->category == 2)
                  Shield
              @elseif($row->category == 3)
                  Headgear
              @elseif($row->category == 4)
                  Body
              @elseif($row->category == 5)
                  Robe
              @elseif($row->category == 6)
                  Shoes
              @elseif($row->category == 7)
                  Accessory
              @elseif($row->category == 8)
                  Card
              @elseif($row->category == 9)
                  เงินเอ็ม
              @elseif($row->category == 10)
                  Cash Shop
              @elseif($row->category == 11)
                  ETC
              @elseif($row->category == 12)
                  ID
              @else
                null
              @endif
            </p></div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
              <a href="{{ URL::to($row->URL_FaceBook) }}" target="_blank">
                <p><font color="#f8fe0f"><U>ติดต่อ </U></font></p></a>
            </div>
            </div>
            <p><font color="#ffffff">{{$row->description}}</font></p>

            <!--Action  -->
            <div style="margin: 10px">
            <form class="form-inline" action = "{{ url('admin_Edit_approve/'.$row->id) }}" method = "get">
              {{ csrf_field()}}
              <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <button type="submit" class="btn btn-success" name="status_blog" value="1">อนุมัติ</button>
              </div>
              <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <button type="submit" class="btn btn-danger" name="status_blog" value="4">ไม่อนุมัติ</button>
              </div>
           </form>
           <div>

            </div>
            @if($row->server == 1)
            <img src="/BG/thor.png" class="new" alt="" />
            @elseif($row->server == 2)
            <img src="/BG/loki.png" class="new" alt="" />
            @elseif($row->server == 3)
            <img src="/BG/vk.png" class="new" alt="" />
            @endif
          </div>
        </div>
      </div>
    @endforeach
    </div>
  </div>
  </div>
  </div>
</body>
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

<div id="myModal" class="modal">
  <span class="close">&times;</span>
  <img class="modal-content" id="myModalImage">
</div>
  @endsection
