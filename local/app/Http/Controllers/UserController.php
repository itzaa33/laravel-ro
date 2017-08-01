<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Image;

use App\post;
use App\product;
use App\User;
use App\history_trading;


use App\Http\Controllers\HomeController;

class UserController extends Controller
{

    public function __construct()
    {
          $this->middleware('auth');
          $this->middleware('check_ban');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {

      ///--------------------------------check category_value-----------------------------------------
      if($request['category_value'] != null)
      {
        $obj['category_return'] = $request['category_value'];

      }
      else
      {
        $obj['category_return'] = $request['category_return'];
      }

      ///--------------------------------end-----------------------------------------
      ///--------------------------------check check min max price-----------------------------------------
      if($request['checkprice'] == null )
      {
          $obj['checkprice'] = 'max';
      }
      else
      {
        $obj['checkprice'] =$request['checkprice'];
      }
///--------------------------------end-----------------------------------------
///--------------------------------check check min max rank-----------------------------------------
      if($request['checkrank'] == null )
      {
          $obj['checkrank'] = 'max';
      }
      else
      {
        $obj['checkrank'] =$request['checkrank'];
      }
///--------------------------------end-----------------------------------------
        $obj['join']=   DB::table('posts')->join('users', 'posts.id_user', '=', 'users.id')
                                           ->join('products', 'posts.id_product', '=', 'products.id')
                                           ->where('posts.status_post','=',1);

    $HomeController = new HomeController;

    $obj = $HomeController->search_item($request,$obj);


    if($obj['category_return'] != null || $request['category_value'] != null)
    {
      $obj['table'] = $obj['join']    ->where('products.category','=',$obj['category_return'])
                                      ->where('posts.status_post','=',1)
                                      ->get();

          if($request['category_value'] != null)
          {
            session(['server'=>'total']);
            session(['upgrade'=>'total']);
            session(['currency'=>'total']);
          }
          else
          {
            $request['category_value'] = $obj['category_return'];
          }


    }


    $obj['BG'] = 'sell-page';

    $obj['url'] = url('user');

    $obj['count'] = $obj['join']->count();

    $obj['table'] = $obj['join'] ->paginate(9);

    $obj['user'] = auth()->user();
//-------------------------------------Check middle ware --------------------------------------
     return view('sell',$obj);

    }




    public function buy_user(Request $request)
    {
      $obj['id_user'] = auth()->user();

      ///--------------------------------check category_value-----------------------------------------
//       if($request['category_value'] != null)
//       {
//         $obj['category_return'] = $request['category_value'];
//
//       }
//       else
//       {
//         $obj['category_return'] = $request['category_return'];
//       }
//       ///--------------------------------end-----------------------------------------
//       ///--------------------------------check check min max price-----------------------------------------
//       if($request['checkprice'] == null )
//       {
//           $obj['checkprice'] = 'max';
//       }
//       else
//       {
//         $obj['checkprice'] =$request['checkprice'];
//       }
// ///--------------------------------end-----------------------------------------
// ///--------------------------------check check min max rank-----------------------------------------
//       if($request['checkrank'] == null )
//       {
//           $obj['checkrank'] = 'max';
//       }
//       else
//       {
//         $obj['checkrank'] =$request['checkrank'];
//       }
///--------------------------------end-----------------------------------------

      $obj['join'] =   DB::table('posts')->join('users', 'posts.id_user', '=', 'users.id')
                                         ->join('products', 'posts.id_product', '=', 'products.id');

      if($request['status_post'] == 'total')
      {
        $obj['join']      ->where('posts.id_user','=',$obj['id_user']->id)
                                         ->where('posts.status_post','!=',5);
      }
      elseif($request['status_post'] == null)
      {
          $obj['join']->where('posts.id_user','=',$obj['id_user']->id)
                                           ->where('posts.status_post','!=',5);
      }
      else
      {
        $obj['join']     ->where('posts.id_user','=',$obj['id_user']->id)
                                         ->where('posts.status_post','=',$request['status_post'])
                                         ->where('posts.status_post','!=',5);
      }
      $obj['table'] = $obj['join']->get();

      $obj['count'] = $obj['table']->count();

      $obj['table'] = $obj['join'] ->paginate(9);

      return view('buy',$obj);
    }

    public function histtory_buy(Request $request)
    {
      $obj['id_user'] = auth()->user();

      $obj['url'] =   $obj['url'] = url('histtory_buy');
      ///--------------------------------check check min max price-----------------------------------------
      if($request['checkprice'] == null )
      {
          $obj['checkprice'] = 'max';
      }
      else
      {
        $obj['checkprice'] =$request['checkprice'];
      }
///--------------------------------end-----------------------------------------

      $obj['join'] =   DB::table('posts')->join('users', 'posts.id_user', '=', 'users.id')
                                         ->join('products', 'posts.id_product', '=', 'products.id');

      $obj['join']                       ->where('posts.id_user','=',$obj['id_user']->id)
                                         ->where('posts.status_post','=',5);


     $HomeController = new HomeController;

     $obj = $HomeController->search_item($request,$obj);

      $obj['table'] = $obj['join']->get();

      $obj['count'] = $obj['table']->count();

      $obj['table'] = $obj['join'] ->paginate(9);


      return view('history_buy',$obj);
    }


    public function history_Search($request,$obj)
    {
      if($request['submit'] == 'Search')
      {
            if($request['server'] != 'total'  )
            {
               $obj['join']  ->where('products.server','=',$request['server']);
               session(['server_history'=>$request['server']]);

            }
            else
            {
                session(['server_history'=>'total']);
            }

            if($request['upgrade'] != 'total')
            {

              $obj['join'] ->where('posts.upgrade','=',$request['upgrade']);
              session(['upgrade_history'=>$request['upgrade']]);
            }
            else
            {
                session(['upgrade_history'=>'total']);
            }
            if($request['currency'] != 'total')
            {
              $obj['join'] ->where('posts.currency','=',$request['currency']);
              session(['currency_history'=>$request['currency']]);
            }
            else
            {
                session(['currency_history'=>'total']);
            }


            $obj['table'] = $obj['join']->get();

      }

      else if($request['checkprice'] != null || $request['checkrank'] != null)
      {

        if(session('server') != 'total'  && session('server') != null )
        {
          $obj['join']  ->where('products.server','=',session('server_history'));
          echo "string3";
        }


        if(session('upgrade') != 'total'&& session('upgrade') != null)
        {
          $obj['join'] ->where('posts.currency','=',session('upgrade_history'));

        }

        if(session('currency') != 'total'&& session('currency') != null)
        {
          $obj['join'] ->where('posts.currency','=',session('currency_history'));

        }

          if($request['checkprice'] != null)
          {
              if($request['checkprice'] == 'max')
              {

                $obj['join']->orderby('posts.price','DESC');
                                            // ->get();
                $obj['checkprice']= 'min';

              }

              elseif($request['checkprice'] ==  'min')
              {
                $obj['join']->orderby('posts.price','ASC');
                                            // ->get();
                $obj['checkprice'] = 'max';

              }
              $obj['table'] = $obj['join']->get();
          }
      }

      return $obj;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $obj['method'] = "post";
        return view('create_blog',$obj);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $this->validate($request, [
        'description' => 'required|string|max:60',
        'title' => 'required|string|max:30',
        'price' => 'required|numeric',
        'image' => 'mimes:jpeg,bmp,png',
    ]);

        $product = new product();
        $product->title     = $request['title'];
        $product->server    = $request['server'];
        $product->category  = $request['category'];
        $product->save();

        $post = new post();
        $post->upgrade      = $request['upgrade'];

        if($request->hasFile('image'))
        {
          $image     = $request->file('image');

          $filename  = time().uniqid(). '.' . $image->getClientOriginalExtension();

          $location  = public_path('images/'.$filename);

          Image::make($image)->resize(1400,800)->save($location);
//1400*800
          $post->image = $filename;
        }
        else
        {
          $post->image      = 'default.png';
        }

        $post->currency     = $request['currency'];
        $post->status_post  = '3';
        $post->price        = intval($request['price']);
        $post->description  = $request['description'];
        $post->id_user      = auth()->user()->id;
        $post->id_product   = $product->id;

        $post->save();
        return redirect(url('buy_user'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data =   DB::table('posts')->where('posts.id_product','=',$id);

        $data = $data->select('id')->first();

        $obj['table'] = post::find($data->id);

        return view('edit',$obj);

    }


    public function save_blogedit(Request $request, $id)
    {

      $this->validate($request, [
        'description' => 'required|string|max:60',
        'price' => 'required|numeric',
        'image' => 'mimes:jpeg,bmp,png',
    ]);

            $post               = post::find($id);
            $post->upgrade      = $request['upgrade'];


            if($request->hasFile('image'))
            {
              $image     = $request->file('image');

              if($image->getClientOriginalName() != $post->image)
              {
                $filename  = time().uniqid(). '.' . $image->getClientOriginalExtension();

                $location  = public_path('images/'.$filename);

                Image::make($image)->resize(1400,800)->save($location);

                $post->image = $filename;
              }

            }

            $post->currency     = $request['currency'];
            $post->price        = intval($request['price']);
            $post->description  = $request['description'];
            $post->save();


            return redirect(url('buy_user'));
    }

    /**
     * update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function action_block(Request $request)
     {


         $data =   DB::table('posts')->where('posts.id_product','=',$request['id']);

         $data = $data->select('id')->first();

         $post = post::find($data->id);

         $post->status_post     = $request['action_block'];

         $post->save();

           return redirect(url('buy_user'));
     }

     public function save_tradingtable($id)
     {

       $id_user = auth()->user();
//---------------------กันโพสเป็นของตนเอง--------------------------------------
        $data =   DB::table('posts')->where('posts.id','=',$id)
                                    ->where('posts.id_user','=',$id_user->id)
                                    ->count();

          $table = DB::table('history_tradings')->where('history_tradings.id_product','=',$id)
                                               ->where('history_tradings.id_user','=',$id_user->id)
                                               ->count();

            if($table == '0' && $data == '0')
            {

              $history_buy_tables = new history_trading();

              $history_buy_tables->id_user =  $id_user->id;
              $history_buy_tables->behavior = '1';
              $history_buy_tables->id_product = $id;
              $history_buy_tables->save();
            }


     }

     public function histtory_sell(Request $request)
     {
       $obj['id_user'] = auth()->user();

       $obj['url'] =   $obj['url'] = url('histtory_sell');
       ///--------------------------------check check min max price-----------------------------------------
       if($request['checkprice'] == null )
       {
           $obj['checkprice'] = 'max';
       }
       else
       {
         $obj['checkprice'] =$request['checkprice'];
       }
 ///--------------------------------end-----------------------------------------
       $obj['join'] =   DB::table('history_tradings')->where('history_tradings.id_user','=', $obj['id_user']->id)
                                                    ->where('history_tradings.behavior','=', '2')
                                                    ->join('posts', 'history_tradings.id_product', '=', 'posts.id')
                                                    ->join('products', 'posts.id_product', '=', 'products.id')
                                                    ->join('users', 'posts.id_user', '=', 'users.id');



        $HomeController = new HomeController;

        $obj = $HomeController->search_item($request,$obj);

       $obj['table'] = $obj['join']->get();

       $obj['count'] = $obj['table']->count();

       $obj['table'] = $obj['join'] ->paginate(9);

       return view('history_sell',$obj);

     }

     public function set_seller(Request $request,$id)
     {

       $obj['id_user'] = auth()->user();

       $obj['join'] =   DB::table('posts')->join('products', 'posts.id_product', '=', 'products.id')
                                          ->where('posts.id','=',$id);



      $obj['table'] = $obj['join']->get();

      $obj['seller'] =   DB::table('history_tradings')->join('users','history_tradings.id_user','=','users.id')
                                                   ->where('history_tradings.behavior','=', '1')
                                                    ->where('history_tradings.id_product','=', $id)
                                                    ->get();

        return view('save_historytrading',$obj);
     }

     public function close_bloge(Request $request)
     {

       $post = post::find($request['product_id']);

       $post->status_post     = '5';

       $post->save();

       $history_buy_tables = new history_trading();

       $history_buy_tables->id_user = intval($request['seller_id']) ;
       $history_buy_tables->behavior = '2';
       $history_buy_tables->id_product = intval($request['product_id']);
       $history_buy_tables->save();

       return redirect(url('buy_user'));
     }

}
