@extends('layouts.app')

@section('content')
<body class="auth-page">
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default" >
        <div class="panel-heading">Create Blog</div>
          <div class="panel-body">


          <form action="{{url('user')}}" method="{{$method}}" enctype="multipart/form-data"  class="form-horizontal" role="form">
            {{ csrf_field()}}

              <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
              <label for="title" class="col-md-4 control-label">ชื่อบล็อค</label>
              <div class="col-md-6">
                <input type="text" name="title" class="form-control" id="title" placeholder="ชื่อบล็อค">
                @if ($errors->has('title'))
                    <span class="help-block">
                        <strong>{{ $errors->first('title') }}</strong>
                    </span>
                @endif
              </div>
              </div>

              <div class="form-group">
                <label for="upgrade" class="col-md-4 control-label">อัพเกรต</label>
                <div class="col-md-6">
                <select  name="upgrade" type="upgrade" value="{{$upgrade or ''}}" id="upgrade" class="form-control">
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
                </select >
              </div>
              </div>


              <div class="form-group">
                <label for="category" class="col-md-4 control-label">ชนิดสินค้า</label>
                <div class="col-md-6">
                  <select  name="category" type="category" value="{{$category or ''}}" id="category" class="form-control">
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
                </div>
              </div>





              <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
              <label for="description" class="col-md-4 control-label">อธิบาย</label>
              <div class="col-md-6">
                <textarea name="description" class="form-control" row ='8' cols="40" id="description" placeholder="คำอธิบาย"></textarea>
                @if ($errors->has('description'))
                    <span class="help-block">
                        <strong>{{ $errors->first('description') }}</strong>
                    </span>
                @endif
              </div>
              </div>



              <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
              <label for="price" class="col-md-4 control-label">ราคา</label>
              <div class="col-md-6">
                <div class = 'form-inline'>
                  <input type="text" name="price" class="form-control" id="price" placeholder="ราคา">
                  <select  name="currency" type="currency" value="{{$currency or ''}}" id="currency" class="form-control">
                    <option value = "1">Zeny</option>
                    <option value = "2">Bath</option>
                  </select >
                    @if ($errors->has('price'))
                        <span class="help-block">
                            <strong>{{ $errors->first('price') }}</strong>
                        </span>
                    @endif
                  </div>
              </div>
              </div>


              <div class="form-group">
                <label for="currency" class="col-md-4 control-label">เซิฟเวอร์</label>
                <div class="col-md-6">
                  <select  name="server" type="server" value="{{$server or ''}}" id="server" class="form-control">
                    <option value = "1">Thor</option>
                    <option value = "2">Loki</option>
                    <option value = "3">Valkyrie</option>
                  </select >
                </div>
              </div>



              <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
              <label for="image" class="col-md-4 control-label">File input</label>
              <div class="col-md-6">
                <input type="file" name="image" id="image">
                @if ($errors->has('image'))
                    <span class="help-block">
                        <strong>{{ $errors->first('image') }}</strong>
                    </span>
                @endif
              </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                  <button type="submit" class="btn btn-primary" >Submit</button>
                </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
  </body>
@endsection
