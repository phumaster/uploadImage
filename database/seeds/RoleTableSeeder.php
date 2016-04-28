<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('roles')->insert([
            'name' => 'admin',
            'description' => str_random(10).'@gmail.com',
            'slug' => '',
        ]);
        DB::table('roles')->insert([
              'name' => 'author',
              'description' => str_random(10).'@gmail.com',
              'slug' => '',
          ]);
          DB::table('roles')->insert([
                'name' => 'user',
                'description' => str_random(10).'@gmail.com',
                'slug' => '',
            ]);
    }
}
