<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\post;
use App\product;
use App\User;
use App\history_ban;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Pagination\Paginator;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{

  public function __construct()
  {
        $this->middleware('auth');
        $this->middleware('check_mod');
        $this->middleware('check_ban');
  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function search_user(Request $request)
     {
       $obj['user'] = auth()->user();

       $obj['join'] = null;

         if($request['type'] != 'title' && $request['type'] != "null"  && $request['type'] != null)
         {
           $obj['join']=   DB::table('users');

           $obj['join'] = $this->if_search($request,$obj);

           $obj['join'] =  $obj['join'] ->where('users.id','!=',auth()->user()->id);

           $obj['join'] = (array)$obj['join']->select('id')->first();

         }
         else if($request['type'] == 'title')
         {
           $obj['join']=   DB::table('posts')->join('products', 'posts.id_product', '=', 'products.id');

           $obj['join'] = $this->if_search($request,$obj);

            $obj['join'] =  $obj['join'] ->where('posts.id_user','!=',auth()->user()->id);

           $obj['join'] = (array)$obj['join']->select('id_user')->first();

         }


        if($obj['join'] != null)
        {
          $obj['join'] =  DB::table('users') -> where('users.id','=', $obj['join']);

          $obj['table'] = $obj['join']->get();

          $obj['count'] = $obj['table']->count();

          $obj['table'] =  $obj['join']->paginate(9);
        }
        else
        {

            $obj['join'] = DB::table('users')->where('users.id','!=',auth()->user()->id);

            $obj['table'] = $obj['join']->get();

            $obj['count'] = $obj['table']->count();

            $obj['table'] =  $obj['join']->paginate(9);
        }

       return view('admin/search_user',$obj);
     }

     public function if_search(Request $request,$obj)
     {
       if($request['type'] == 'name')
       {
         $obj['join'] = $obj['join'] ->  where('users.name','=',$request['value']);
       }
       elseif($request['type'] == 'URL_FaceBook')
       {
         $obj['join'] = $obj['join'] ->  where('users.URL_FaceBook','=',$request['value']);
       }
       elseif($request['type'] == 'email')
       {
         $obj['join'] = $obj['join'] ->  where('users.email','=',$request['value']);
       }
       elseif($request['type'] == 'title')
       {
         $obj['join'] = $obj['join'] ->  where('products.title','=',$request['value']);
       }
       return $obj['join'];
     }

     public function admin_approve()
     {
       $obj['user'] = auth()->user();

       $obj['join']=   DB::table('posts')->join('users', 'posts.id_user', '=', 'users.id')
                                          ->join('products', 'posts.id_product', '=', 'products.id');

      $obj['table'] =  $obj['join']    ->where('posts.status_post','=',3)
                                      ->get();

      $obj['count'] = $obj['table']->count();

      $obj['table'] =       $obj['join'] ->paginate(9);


       return view('admin/admin_approve',$obj);
     }

     public function admin_Edit_approve(Request $request,$id)
     {

       $data =   DB::table('posts')->where('posts.id_product','=',$id);

       $data = $data->select('id')->first();

       $post = post::find($data->id);

       $post->status_post = $request['status_blog'];

       $post->save();

       return redirect(url('admin_approve'));
     }

    public function index(Request $request)
    {
      $obj['user'] = auth()->user();

      $obj['join'] =  DB::table('history_bans')->join('users as admin', 'history_bans.id_admin', '=', 'admin.id')
                                            ->join('users', 'history_bans.id_user', '=', 'users.id')
                                            ->orderby('history_bans.created_at','DESC')
                                            ->select(DB::raw('history_bans.*,admin.name as name_admin, admin.rank as rank_admin,users.*'));
      
    $this->if_search($request,$obj);

    $obj['table'] = $obj['join']->get();

    $obj['count'] = $obj['table']->count();

    $obj['table'] = $obj['join'] ->paginate(20);

    return view('admin/history_ban',$obj);
    }

    public function addrank(Request $request ,$id)
    {
      if($request['rank'] != null)
      {
          $user = User::find($id);
          $user->rank = $request['rank'];
          $user->save();
      }

      return redirect(url('search_user'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)     //--------------move to ban and sent id user------------------------
    {
      $obj['user'] = auth()->user();
      $obj['table'] = user::find($id);

      return view('admin/set_ban',$obj);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) //-------------------- save status ban  and create historyban  and save
    {
      $id_user = auth()->user();
      $user               = user::find($id);
      $user->status_ban   = '1';
      $user->save();

      $history_ban               = new history_ban();
      $history_ban->id_admin     = $id_user->id;
      // $history_ban->name_admin     = $id_user->name;
      // $history_ban->rank_admin     = $id_user->rank;
      $history_ban->id_user      = $id;
      $history_ban->description  = $request['description'];
      $history_ban->command      = 1;
      $history_ban->save();

      $this->status_post($id,2);

      return redirect(url('admin'));
    }

    public function status_post( $id,$status_ban)
    {
      $table = post::all();
      foreach($table as $table_user)
      {
        if($table_user->id_user == $id)
        {
          if($table_user->status_post == 1)
          {
            $table_user->status_post = $status_ban;
            $table_user->save();
          }
        }
      }
    }
    public function unban_post($id)
    {
      $id_user = auth()->user();
      $user               = user::find($id);
      $user->status_ban   = '0';
      $user->save();

      $history_ban               = new history_ban();
      $history_ban->id_admin     = $id_user->id;
      // $history_ban->name_admin     = $id_user->name;
      // $history_ban->rank_admin     = $id_user->rank;
      $history_ban->id_user      = $id;
      $history_ban->command      = 0;
      $history_ban->save();

      $this->status_post($id,2);

      return redirect(url('search_user'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
