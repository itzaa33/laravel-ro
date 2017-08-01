<?php
use Illuminate\Support\Facades\Input as input;
use App\User;
use Validator;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware'=>['web']], function()
 {


   Route::get('/url-facebook',function(){
     return view('url-facebook');
   });

      Route::get('/changepassword',function(){
        return view('auth.change_password');
      });

      Route::post('/change/password',function(){
        $User = User::find(Auth::user()->id);

        $validator = Validator::make(Input::get(), [
          'password' => 'required|numeric|min:6',
       ]);

       if ($validator->fails()) {
            return      back()
                        ->withErrors($validator)
                        ->withInput();
        }

        if(Hash::check(Input::get('passwordold'),$User['password']) && Input::get('password') == Input::get('password_confirmation'))
        {
          $User->password = bcrypt(Input::get('password'));
          $User->save();
          return back()->with('success','Password Changed');
        }
        else
        {
          return back()->with('error','Password NOT Changed!!');
        }
      });

      Route::get('/home', 'HomeController@index')->middleware('auth','HomeCheckRank');

      Auth::routes();

      Route::resource('admin','AdminController');

      Route::resource('mod','ModController');

      Route::resource('user','UserController');

      Route::post('save_blogedit/{id}','UserController@save_blogedit');

      Route::get('/','HomeController@first_page');

      Route::get('/select_type_item', function () {
          return view('select_type_item');
      });


      Route::get('/buy_user', 'UserController@buy_user');

      Route::get('/re_password', function () {
          return view('re_password');
      });


      Route::get('/admin_home', function () {
          return view('admin/admin_home');
      });

      Route::get('/mod_home', function () {
          return view('mod/mod_home');
      });

      Route::get('/Edit_AccoutFacebookPhone', function () {
          return view('set_email_facebook');
      });

      Route::get('/action_block', 'UserController@action_block');

      Route::get('/histtory_buy', 'UserController@histtory_buy');

      Route::get('max_min_price','UserController@max_min_price');

      Route::get('admin_approve','AdminController@admin_approve')->middleware('check_admin');;

      Route::get('admin_Edit_approve/{id}','AdminController@admin_Edit_approve')->middleware('check_admin');;

      Route::get('search_user','AdminController@search_user');

      Route::get('un_ban_post/{id}','AdminController@unban_post');

      Route::get('addrank/{id}','AdminController@addrank');

      Route::get('Update_AccoutFacebookPhone/{id}','Auth\LoginController@Update_AccoutFacebookPhone');

      Route::get('save_tradingtable/{id}', 'UserController@save_tradingtable');

      Route::get('set_seller/{id}', 'UserController@set_seller');

      Route::get('close_bloge', 'UserController@close_bloge');

      Route::get('/histtory_sell', 'UserController@histtory_sell');

});


//-------------------------------Route Facebook---------------------------------------------------
Route::group(['middleware' => 'web'],function () {

  Route::get('auth/facebook',[
  'as' => 'auth-facebook',
  'uses' => '\App\Http\Controllers\Auth\LoginController@redirectToProvider'
  ]);

  Route::get('auth/facebook/callback',[
  'as' => 'facebook-callback',
  'uses' => '\App\Http\Controllers\Auth\LoginController@handleProviderCallback'
  ]);

});
