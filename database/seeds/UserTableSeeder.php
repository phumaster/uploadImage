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
          'name' => 'Administrator',
          'email' => 'phumaster.dev@gmail.com',
          'password' => bcrypt('123456'),
          'friends' => json_encode([2 => 0.0, 3 => 0.0, 4 => 0.1, 5 => 0.2])
      ]);

      DB::table('users')->insert([
            'name' => 'Phú Master',
            'email' => 'phumaster@gmail.com',
            'password' => bcrypt('secret'),
            'friends' => json_encode([1 => 0.0, 3 => 0.2, 4 => 0.0])
        ]);
        DB::table('users')->insert([
              'name' => 'Phú Founder',
              'email' => 'phufounder@gmail.com',
              'password' => bcrypt('secret'),
              'friends' => json_encode([1 => 0.0, 2 => 0.1, 4 => 0.0])
          ]);
          DB::table('users')->insert([
                'name' => 'Phú Monster',
                'email' => 'phumonster@gmail.com',
                'password' => bcrypt('secret'),
                'friends' => json_encode([1 => 0.0, 2 => 0.4, 3 => 0.0])
            ]);
            DB::table('users')->insert([
                  'name' => 'Phú Cốt Đờ',
                  'email' => 'phucoder@gmail.com',
                  'password' => bcrypt('secret'),
                  'friends' => json_encode([1 => 0.0, 2 => 0.4, 3 => 0.0])
              ]);
    }
}
