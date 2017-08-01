<?php

namespace App\Http\Controllers\Auth;
use App\Http\Requests;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\User;


use Validator;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }
    public function handleProviderCallback()
    {
      try
      {
          $user = Socialite::driver('facebook')->user();
      }
      catch(\Exception $e)
      {
        return redirect(url('home'));
      }

//------------------------------------------register PhoneNumber----------------------------------------------------
      if($user->getEmail() == null)
      {
        $check['id'] = User::where('id_provider',$user->getId())->first();
        $check['name'] = User::where('name',$user->getName())->first();

        if($check['name'] == null)
        {
            if($check['id'] == null)
            {
              User::create([
                'name' => $user->getName(),
                'rank' => "User",
                'status_ban' => 0,
                'provider' => "Facebook",
                'id_provider' => $user->getId(),
                'URL_FaceBook' => "https://www.facebook.com/".$user->getId(),
              ]);
            }
            $check['checkid'] = null;
            $check['id'] = User::where('id_provider',$user->getId())->first();
            return view('set_email_facebook',$check);
        }
        
        auth()->login($check['id']);

        return  redirect()->to('/home');
      }

//------------------------------------------register Email----------------------------------------------------
        $checkID = User::where('id_provider',$user->getId())->first();
        $checkEmail = User::where('email',$user->getEmail())->first();

        if($checkID == null &&  $checkEmail == null)
        {
          User::create([
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'rank' => "User",
            'status_ban' => 0,
            'provider' => "Facebook",
            'id_provider' => $user->getId(),
            'URL_FaceBook' => "https://www.facebook.com/".$user->getId(),
          ]);

          $checkID = User::where('id_provider',$user->getId())->first();

          auth()->login($checkID);
        }
        elseif(!$checkID)
        {
          $dataUser = User::find($checkEmail->id);
          $dataUser->id_provider = $user->getId();
          $dataUser->save();
          auth()->login($checkEmail);
        }
        else
        {
          $checkEmail = User::where('email',$user->getEmail())->first();
          auth()->login($checkEmail);
        }

        return  redirect()->to('/home');
    }

    public function Update_AccoutFacebookPhone(Request $request,$id)
    {

      $checkEmail = User::where('email',$request['email'])->first();

      if($checkEmail == null)
      {
        $user = User::find($id);
        $user->email = $request['email'];
        $user->save();

        auth()->login($user);

        return  redirect()->to('/home');
      }
      elseif($checkEmail != null)
      {
        $obj['id'] = User::where('id',$id)->first();
        $obj['checkid'] = 'The email has already been taken.';
        return view('set_email_facebook',$obj);
      }
    }

}
