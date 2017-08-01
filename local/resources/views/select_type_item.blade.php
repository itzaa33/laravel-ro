@extends('layouts.app')

@section('content')
<body class="select-type-page">
  <div class="container">
    <div class="row">
      <form action = "{{url('user')}}" method = "get" >
        {{ csrf_field()}}
          <div class="col-xl-12" align="center" style="margin: 15px;">

            <button class="bttn-gradient bttn-lg" type="submit" name="category_value" value="1">Weapon</button>
            <button class="bttn-gradient bttn-lg"  type="submit" name="category_value" value="2">Shield</button>
            <button class="bttn-gradient bttn-lg"  type="submit" name="category_value" value="3">Headgear</button>
            <button class="bttn-gradient bttn-lg"   type="submit" name="category_value" value="4">Body</button>
          </div>

          <div class="col-xl-12" align="center" style="margin: 15px;">

            <button class="bttn-gradient bttn-lg"   type="submit" name="category_value" value="5">Robe</button>
            <button class="bttn-gradient bttn-lg"  type="submit" name="category_value" value="6">Shoes</button>
            <button class="bttn-gradient bttn-lg"   type="submit" name="category_value" value="7">Accessory</button>
            <button class="bttn-gradient bttn-lg"   type="submit" name="category_value" value="8">Card</button>

          </div>

          <div class="col-xl-12" align="center" style="margin: 15px;">
            <button class="bttn-gradient bttn-lg"   type="submit" name="category_value" value="9">Money</button>
            <button class="bttn-gradient bttn-lg"   type="submit" name="category_value" value="10">Cash Shop</button>
            <button class="bttn-gradient bttn-lg"   type="submit" name="category_value" value="11">ETC </button>
            <button class="bttn-gradient bttn-lg"   type="submit" name="category_value" value="12">ID </button>
          </div>


          <input type="hidden" name="server" value= "total">
          <input type="hidden" name="upgrade" value= "total">
          <input type="hidden" name="currency" value= "total">
          <input type="hidden" name="chech_first_in" value= "true">

      </form>
    </div>
  </div>
</body>
@endsection
