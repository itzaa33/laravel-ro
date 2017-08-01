@extends('layouts.app')

@section('content')


<script>

$(document).ready(function()
{
  var i = {{$user->status_ban}};
  if( i == '1')
  {
    $('#myModal').modal('show');
  }
});
</script>

<body class="bodyBG-home">

 <div class="container">

   <!--ส่วนของ Modal สังเกตุ id myModal ครับ ส่วนนี้แหละจะถูกเรียกด้วย Java Script -->
   <div class="modal fade" id="myModal" role="dialog">
     <div class="modal-dialog">

       <!-- เนือหาของ Modal ทั้งหมด -->
       <div class="modal-content">
        <!-- ส่วนหัวของ Modal  -->
        <div class="modal-header">
         <!-- ปุ่มกดปิด (X) ตรงส่วนหัวของ Modal  -->
         <button type="button" class="close" data-dismiss="modal">&times;</button>
         <h4 class="modal-title">ประกาศ</h4>
       </div>
       <!-- ส่วนเนื้อหาของ Modal  -->
       <div class="modal-body">
         <p>ไอดีนี้ถูกระงับการใช้งาน กรุณาติดต่อผู้ที่มีระดับMod,Admin</p>
       </div>
       <div class="modal-footer">
        <!-- ปุ่มกดปิด (Close) ตรงส่วนล่างของ Modal  -->
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
  </div>
</div>


  <div class="container" align="center">
      <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
      <a href="{{url('buy_user')}}"><img src="{{asset('/BG/'.'Buy_button_home.png')}}" class="image" ></a>
      </div>
      <div class="col-xs-12 col-sm-5 col-md-5 col-lg-5">
      <a  href="{{url('select_type_item')}}"><img src="{{asset('/BG/'.'Sell_button_home.png')}}"class="image"></a>
      </div>
  </div>
</body>
@endsection
