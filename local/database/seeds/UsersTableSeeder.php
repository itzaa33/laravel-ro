<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $user = new \App\User([
          'name' => 'ProTroGus',
          'email' => 'kamikaze-clubJung@hotmail.com',
          'password' => Hash::make('35778741'),
          'rank' => 'Admin',
          'status_ban' => 0,
          'provider' => 'Normal',
          'id_provider' => null,
          'URL_FaceBook' => 'https://www.facebook.com/itjung.awink'  ]);
      $user->save();
    }
}
