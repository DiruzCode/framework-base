<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $users = [
          ['email' => 'admin@admin.com', 'hidden' => true, 'role' => 'super-administrador'],
      ];

      foreach ($users as $item){

          $user = User::create([
              'email' => $item['email'],
              'password' => 'Bullish20!!',
              'remember_token' => str_random(10),
              'status' => 'active',
              'hidden' => $item['hidden']
          ]);

          $user->assignRole($item['role']);

      }

    }
}
