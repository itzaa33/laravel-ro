@extends('layouts.app')
<body class="buy-page">
@section('content')
    @yield('head')
    <div class="container">
        <div class="navbar navbar-inverse ">
            <div class="container-fluid">

              <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#sell-collapse">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                </button>
              </div>

              <ul class="nav navbar-nav collapse navbar-collapse" id="search-collapse">
                <form class="form-inline" action = "{{url('buy_user')}}" method = "get">
                    {{ csrf_field()}}
                    <select  name="status_post" type="select"  id="status_post" class="form-control" onchange="this.form.submit()">
                      <option >เลือกสถานะร้าน</option>
                      <option value = "1" >เปิด</option>
                      <option value = "2">ปิด</option>
                      <option value = "3">รออนุมัติ</option>
                      <option value = "4">ไม่อนุมัติ</option>
                      <option value = "total">ทั้งหมด</option>
                    </select >

                      <a class="btn btn-primary" href="{{url('user/create')}}"> Create </a>
                </form>
            </ul>
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
                <img src="{{asset('/local/public/images/'.$row->image)}}" alt="" id ="{{$row->id}}" onClick="show('{{$row->id}}') ">

                <div class ="rank">ระดับ: {{$row->rank}}</div>

                <div class ="status-post">
              <p>@if($row->status_post == 1)
                    เปิด
                  @elseif($row->status_post == 2)
                    ปิด
                  @elseif($row->status_post == 3)
                    รออนุมัติ
                  @elseif($row->status_post == 4)
                    ไม่อนุมัติ
                  @endif</p>
                </div>

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
              @if($row->status_post == 1)
              <div class="form-inline" style="margin: 10px">
                 <form action = "{{ url('action_block') }}" method = "get" class="form-group">
                   {{ csrf_field()}}
                   <a class="btn btn-warning" href="{{url('user/'.$row->id.'/edit')}}">แก้ไข</a>
                   <input type="hidden" name="id" value="{{$row->id}}">
                   <button type="submit" class="btn btn-secondary" name="action_block" value="2">ปิด</button>
                </form>
                <form action = "{{ url('set_seller/'.$row->id) }}" method = "get" class="form-group">
                  <button class="btn btn-danger" name="action_block" value="5">ลบ</button>
                </form>
              </div>

              @elseif($row->status_post == 2)
              <div class="form-inline" style="margin: 10px">
                <form action = "{{ url('action_block') }}" method = "get" class="form-group">
                  {{ csrf_field()}}
                  <a class="btn btn-warning" href="{{url('user/'.$row->id.'/edit')}}">แก้ไข</a>
                  <input type="hidden" name="id" value="{{$row->id}}">

                  <button type="submit" class="btn btn-success" name="action_block" value="1">เปิด</button>
               </form>
               <form action = "{{ url('set_seller/'.$row->id) }}" method = "get" class="form-group">
                 <button class="btn btn-danger" name="action_block" value="5">ลบ</button>
               </form>
             </div>



              @elseif($row->status_post == 3)
              <form action = "{{ url('set_seller/'.$row->id) }}" method = "get">
                <button class="btn btn-danger" name="action_block" value="5">ลบ</button>
              </form>


              @elseif($row->status_post == 4)
              <div class="form-inline" style="margin: 10px">
              <form action = "{{ url('action_block') }}" method = "get" class="form-group">
                <a class="btn btn-warning" href="{{url('user/'.$row->id.'/edit')}}">แก้ไข</a>
                {{ csrf_field()}}
                <input type="hidden" name="id" value="{{$row->id}}">
                <button type="submit" class="btn btn-info" name="action_block" value="3">ส่ง</button>
             </form>
             <form action = "{{ url('set_seller/'.$row->id) }}" method = "get" class="form-group">
               <button class="btn btn-danger" name="action_block" value="5">ลบ</button>
             </form>
          </div>
              @endif<!--Action  -->

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


    <div id="myModal" class="modal">

      <span class="close" data-dismiss="modal" name="button">&times;</span>
      <img class="modal-content" id="myModalImage">

    </div>

    <div id="data-modalselec-seller" class="modal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button"class="close" data-dismiss="modal" name="button">&times;</button>
            <h4 class="modal-title">เลือกผู้ซื้อ</h4>

          </div>
          <div class="modal-body" id="select-data">

          </div>
          <div class="modal-footer">
              <button type="button"class="btn btn-danger" data-dismiss="modal" name="button">Close</button>
          </div>

        </div>

      </div>
    </div>
    @yield('dow')



    @endsection
