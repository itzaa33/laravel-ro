@extends('layouts.app')

@section('content')
<body class="{{$BG}}">

<div class="container" >
  <div class="row">
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

      <div class="mainmenu pull-left">
        <ul class="nav navbar-nav collapse navbar-collapse" id="sell-collapse">
          <form class="form-inline" action = "{{$url}}" method = "get">
            {{ csrf_field()}}

              <select  name="server" type="select" value="{{$server or ''}}" id="server" class="form-control">
                  <option value = null>เลือก</option>
                  <option value = "1">Thor</option>
                  <option value = "2">Loki</option>
                  <option value = "3">Valkyrie</option>
                  <option value = "total">ทั้งหมด</option>
                </select >

              <select  name="upgrade" type="upgrade"  id="upgrade" class="form-control">
                    <option value = null>เลือก</option>
                    <option value = "0">0</option>
                    <option value = "1">+1</option>
                    <option value = "2">+2</option>
                    <option value = "3">+3</option>
                    <option value = "4">+4</option>
                    <option value = "5">+5</option>
                    <option value = "6">+6</option>
                    <option value = "7">+7</option>
                    <option value = "8">+8</option>
                    <option value = "9">+9</option>
                    <option value = "10">+10</option>
                    <option value = "total">ทั้งหมด</option>
                  </select >

              <select  name="currency" type="currency"  value="{{$currency or ''}}" id="currency" class="form-control">
                    <option value = null>เลือก</option>
                    <option value = "1">Z</option>
                    <option value = "2">B</option>
                    <option value = "total">ทั้งหมด</option>
                  </select >


                  @if($checkprice == 'max')
                  <button class="btn btn-primary" type="submit" name="checkprice" value="{{$checkprice or  'max'}}" >
                  <span class="glyphicon glyphicon-sort-by-order" ></span>
                  ราคาสูงสุด
                  </button>
                  @else
                  <button class="btn btn-primary" type="submit" name="checkprice" value="{{$checkprice or  'max'}}" >
                  <span class="glyphicon glyphicon-sort-by-order-alt" aria-hidden="true"></span>
                  ราคาต่ำสุด
                  </button>
                  @endif


                  @if($checkrank == 'max')
                  <button class="btn btn-primary" type="submit" name="checkrank" value="{{$checkrank or  'max'}}" >
                  <span class="glyphicon glyphicon-sort-by-alphabet" ></span>
                  ระดับสูงสุด
                  </button>
                  @else
                  <button class="btn btn-primary" type="submit" name="checkrank" value="{{$checkrank or  'max'}}" >
                  <span class="glyphicon glyphicon-sort-by-alphabet-alt" aria-hidden="true"></span>
                  ระดับต่ำสุด
                  </button>
                  @endif

                <input type="hidden" value="{{$category_return or ''}}" name = "category_return" id = "category_return">
        </ul>
      </div>


      <div class="search_box pull-right">
        <button type="submit" name = "submit" value="Search" class="btn btn-primary">Search</button>
      </div>
    </div>
  </div>
</form>
</div>
</div>

<div class="container" >
  <div class="row">
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
            <div class="col-xs-12 col-sm-6 col-md-12">
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
          </p>



            <a href="{{ URL::to($row->URL_FaceBook) }}" target="_blank" onClick="save_tradingtable('{{$row->id}}')">
              <p><font color="#f8fe0f"><U>ติดต่อ </U></font></p></a>

          </div>
          </div>


          <p style="color: white;">{{$row->description}}</p>


          <!--Action  -->
          @if($user->rank == 'Admin' || $user =='Mod')
              <form method="get" action="{{ url('admin/'.$row->id_user.'/edit') }}" style="margin: 10px">
                {{ method_field('PUT') }}
                {{ csrf_field()}}
                @if($row->status_ban == 0 && $row->id_user != $user->id)
                  <button type="submit" class="btn btn-danger" name="action_block">แบน</button>
                @endif
              </form>
          @endif

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

<script>


function save_tradingtable(id) {
  var xhttp = new XMLHttpRequest();
  var csrfToken = "{{ csrf_token() }}";

  xhttp.open("GET", "save_tradingtable/"+id, true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send();

}
</script>

</body>

@endsection
