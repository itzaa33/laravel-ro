
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
        <ul class="nav navbar-nav collapse navbar-collapse" id="sell-collapse" style="margin: 15px;">
          <form class="form-inline" action = "{{$url}}" method = "get">
            {{ csrf_field()}}
            <select   name = "category_return" type="select" value="{{$category_return or ''}}"  id = "category_value" class="form-control">
                <option value = ''>เลือก</option>
                <option value = "1">Weapon</option>
                <option value = "2">Shield</option>
                <option value = "3">Headgear</option>
                <option value = "4">Body</option>
                <option value = "5">Robe</option>
                <option value = "6">Shoes</option>
                <option value = "7">Accessory</option>
                <option value = "8">Card</option>
                <option value = "9">เงินเอ็ม</option>
                <option value = "10">Cash Shop</option>
                <option value = "11">ETC</option>
                <option value = "12">ID</option>
              </select >

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
          </div>
          <p><font color="#ffffff">{{$row->description}}</font></p>

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

</body>

@endsection
