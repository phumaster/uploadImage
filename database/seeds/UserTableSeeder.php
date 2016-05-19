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
          'friends' => json_encode([2 => 0, 3 => 0, 4 => 1])
      ]);

      DB::table('users')->insert([
            'name' => str_random(10),
            'email' => str_random(10).'@gmail.com',
            'password' => bcrypt('secret'),
            'friends' => json_encode([1 => 0, 3 => 2, 4 => 0])
        ]);
        DB::table('users')->insert([
              'name' => str_random(10),
              'email' => str_random(10).'@gmail.com',
              'password' => bcrypt('secret'),
              'friends' => json_encode([1 => 0, 2 => 1, 4 => 0])
          ]);
          DB::table('users')->insert([
                'name' => str_random(10),
                'email' => str_random(10).'@gmail.com',
                'password' => bcrypt('secret'),
                'friends' => json_encode([1 => 0, 2 => 4, 3 => 0])
            ]);
    }
}
