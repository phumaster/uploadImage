<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('users')->insert([
          'name' => str_random(10),
          'email' => 'phumaster.dev@gmail.com',
          'password' => bcrypt('123456'),
          'friends' => '[2, 3, 4]'
      ]);

      DB::table('users')->insert([
            'name' => str_random(10),
            'email' => str_random(10).'@gmail.com',
            'password' => bcrypt('secret'),
            'friends' => '[1, 3, 4]'
        ]);
        DB::table('users')->insert([
              'name' => str_random(10),
              'email' => str_random(10).'@gmail.com',
              'password' => bcrypt('secret'),
              'friends' => '[1, 2 , 4]'
          ]);
          DB::table('users')->insert([
                'name' => str_random(10),
                'email' => str_random(10).'@gmail.com',
                'password' => bcrypt('secret'),
                'friends' => '[1, 2, 3]'
            ]);
    }
}
