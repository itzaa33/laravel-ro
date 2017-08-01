<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $obj['user'] = auth()->user();
        return view('home',$obj);
    }

     public function first_page(Request $request)
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


     $obj = $this->search_item($request,$obj);


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




     $obj['BG'] = 'first-page';

      $obj['url'] = url('/');

     $obj['count'] = $obj['join']->count();

     $obj['table'] =       $obj['join'] ->paginate(9);

     $obj['user'] = auth()->user();
 //-------------------------------------Check middle ware --------------------------------------


        return view('first_page',$obj);
     }

     public function search_item($request,$obj)
     {


         if($request['submit'] == 'Search')
         {
               if($request['server'] != 'total'  )
               {
                  $obj['join']  ->where('products.server','=',$request['server']);
                  session(['server'=>$request['server']]);

               }
               else
               {
                   session(['server'=>'total']);
               }

               if($request['upgrade'] != 'total')
               {

                 $obj['join'] ->where('posts.upgrade','=',$request['upgrade']);
                 session(['upgrade'=>$request['upgrade']]);
               }
               else
               {
                   session(['upgrade'=>'total']);
               }
               if($request['currency'] != 'total')
               {
                 $obj['join'] ->where('posts.currency','=',$request['currency']);
                 session(['currency'=>$request['currency']]);
               }
               else
               {
                   session(['currency'=>'total']);
               }

               session(['category_return'=>$request['category_return']]);


         }
     //------------------------------------------ min max price---------------------------------------------
         else if($request['checkprice'] != null || $request['checkrank'] != null)
         {

           if(session('server') != 'total'  && session('server') != null )
           {
             $obj['join']  ->where('products.server','=',session('server'));
           }


           if(session('upgrade') != 'total'&& session('upgrade') != null)
           {
             $obj['join'] ->where('posts.upgrade','=',session('upgrade'));
           }

           if(session('currency') != 'total'&& session('currency') != null)
           {
             $obj['join'] ->where('posts.currency','=',session('currency'));

           }

             if($request['checkprice'] != null)
             {
                 if($request['checkprice'] == 'max')
                 {

                   $obj['table'] = $obj['join']->orderby('posts.price','DESC');

                                               // ->get();
                   $obj['checkprice']= 'min';



                 }

                 else  if($request['checkprice'] ==  'min')
                 {
                   $obj['table'] = $obj['join']->orderby('posts.price','ASC');
                                               // ->get();
                   $obj['checkprice'] = 'max';

                 }
             }
             else
             {
               if($request['checkrank'] == 'max')
               {

                 $obj['table'] = $obj['join']->orderby('users.rank','DESC');
                 $obj['checkrank']= 'min';
               }

               else  if($request['checkrank'] ==  'min')
               {
                 $obj['table'] = $obj['join']->orderby('users.rank','ASC');
                 $obj['checkrank'] = 'max';
               }
             }
         }



       return $obj;
     }

}
