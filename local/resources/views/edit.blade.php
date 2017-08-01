@extends('layouts.app')
<body class="auth-page">
@section('content')
<!-- selected upgrate -->
<script type="text/javascript">
$(document).ready(function(){
  var text1 = {{$table->upgrade}};
    $("select option").filter(function()
    {
     //may want to use $.trim in here
     return $(this).text() == text1;
    }).attr('selected', true);
});
</script>

<div class = "container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default" >
        <div class="panel-heading">Create Blog</div>
        <div class="panel-body">
          <form method="post" action="{{ url('save_blogedit/'.$table->id) }}" enctype="multipart/form-data" class="form-horizontal" role="form">
            {{ csrf_field()}}

            <div class="form-group">
              <label for="upgrade"class="col-md-4 control-label">อัพเกรต</label>

              <div class="col-md-6">
                <select  name="upgrade" type="upgrade" value="{{$table->upgrade or ''}}" id="upgrade" class="form-control">
                  <option selected="selected" >เลือก</option>
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
              <label for="description" class="col-md-4 control-label">อธิบาย</label>
            <div class="col-md-6">
              <textarea name="description" class="form-control" row ='8' cols="40" id="description" placeholder="คำอธิบาย">{{$table->description}}</textarea>
            </div>
            </div>

              <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
              <label for="price" class="col-md-4 control-label">ราคา</label>
              <div class = 'form-inline'>
                <div class="col-md-6">
                <input type="text" name="price" class="form-control" id="price" value="{{$table->price or ''}}" placeholder="ราคา">
                <select  name="currency" type="currency" value="{{$table->currency }}" id="currency" class="form-control">
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
@endsection
</body>
