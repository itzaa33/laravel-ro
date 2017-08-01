@extends('layouts.app')
<body class="buy-page">
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
          <div class="panel-heading">กรอกผู้ซื้อ</div>
          @foreach($table as $row)

          <form method="get" action="{{ url('close_bloge') }}" class="form-horizontal" role="form">
            <input type="hidden" name="product_id" id="product_id" value="{{$row->id}}">

            <div class="panel-body">

            <div class="form-group" align=center>
              <img class="img-thumbnail" src="{{asset('/local/public/images/'.$row->image)}}" alt="">
            </div>

                <div class="form-group">
                  <label for="name" class="col-md-4 control-label">ราคา:</label>
                  <div class="col-md-6">
                    <li class="list-group-item">{{$row->price}}
                      @if($row->currency == 1)
                      Z
                      @elseif($row->currency == 2)
                      B
                      @endif
                    </li>

                  </div>
                </div>

                <div class="form-group">
                  <label for="email" class="col-md-4 control-label">ประเภท:</label>
                  <div class="col-md-6">
                    <li class="list-group-item">
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
                    </li>
                  </div>
                </div>


              <div class="form-group">
                <label for="upgrade" class="col-md-4 control-label">Server: </label>
                <div class="col-md-6">
                  <li class="list-group-item">
                    @if($row->server == 1)
                    Thor
                    @elseif($row->server == 2)
                    Loki
                    @elseif($row->server == 3)
                    Valkyrie
                    @endif</li>
                </div>
              </div>

                <div class="form-group">
                  <label for="upgrade" class="col-md-4 control-label">คำอธิบาย: </label>
                  <div class="col-md-6">
                    <li class="list-group-item">{{$row->description}}</li>
                  </div>
                </div>
                @endforeach


                <div class="form-group">
                  <label for="upgrade" class="col-md-4 control-label">โปรดเลือกชื่อผู้ซื้อ</label>
                  <div class="col-md-6">
                    <select type="select"  name="seller_id" id="seller_id" class="form-control">
                      <option value = '0'>ไม่มีผู้ซื้อ</option>
                      @foreach($seller as $data)
                      <option value = "{{$data->id}}">{{$data->name}}</option>
                      @endforeach
                    </select >
                  </div>
                </div>


                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                      <button type="submit" class="btn btn-primary" value="eiei">Submit</button>
                    </div>
                </div>
            </form>
          <div>
        </div>
      </div>
    </div>
  </div>
</div>


@endsection
</body>
