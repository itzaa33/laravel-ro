@extends('layouts.app')
<body class="buy-page">
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
          <div class="panel-heading">Ban</div>
            <div class="panel-body">
              <form action = "{{route('admin.update',$table->id)}}" method = "post" class="form-horizontal" role="form">
            {{ method_field('PUT') }}
            {{ csrf_field()}}


                <div class="form-group">
                  <label for="name" class="col-md-4 control-label">Name</label>
                  <div class="col-md-6">
                    <li class="list-group-item">{{$table->name}}</li>
                  </div>
                </div>

                <div class="form-group">
                  <label for="email" class="col-md-4 control-label">E-Mail</label>
                  <div class="col-md-6">
                    <li class="list-group-item">{{$table->email}}</li>
                  </div>
                </div>

                <div class="form-group">
                  <label for="upgrade" class="col-md-4 control-label">URL-Facebook</label>
                  <div class="col-md-6">
                    <li class="list-group-item">{{$table->URL_FaceBook}}</li>
                  </div>
                </div>

                <div class="form-group">
                  <label for="upgrade" class="col-md-4 control-label">Update</label>
                  <div class="col-md-6">
                    <select  name="description" type="upgrade" value="{{$table->description}}" id="description" class="form-control">
                      <option value = "1">โกงเงินหรือโกงสินค้าของผู้อื่น</option>
                      <option value = "2">จงใจสร้างบล็อคที่คล้ายๆกันหลายๆบล็อค</option>
                      <option value = "3">ใส่ร้ายผู้อื่น</option>
                      <option value = "4">ไม่มีของที่ขายในบล็อคที่สร้าง</option>
                    </select >
                  </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                      <button type="submit" class="btn btn-primary" value="eiei">Submit</button>
                    </div>
                </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>


@endsection
</body>
