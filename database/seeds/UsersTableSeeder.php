<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $users = [
            [
                'username' => 'superadmin',
                'email' => 'nguyenthanhh4u@gmail.com',
                'fullname' => 'Super Admin',
                'password' => bcrypt('123123'),
                'gender' => 'male',
                'phone' => '0352494949',
                'role' => 'superadmin'
            ],[
                'username' => 'admin',
                'email' => $faker->unique()->safeEmail,
                'fullname' => $faker->name,
                'password' => bcrypt('123123'),
                'gender' => 'male',
                'phone' => '0352494949',
                'role' => 'admin'
            ],[
                'username' => 'editor',
                'email' => $faker->unique()->safeEmail,
                'fullname' => $faker->name,
                'password' => bcrypt('123123'),
                'gender' => 'male',
                'phone' => '0352494949',
                'role' => 'editor'
            ],[
                'username' => Str::random(10),
                'email' => $faker->unique()->safeEmail,
                'fullname' => $faker->name,
                'password' => bcrypt('123123'),
                'gender' => 'male',
                'phone' => '0352494949',
                'role' => 'member'
            ]
        ];
 
        foreach($users as $u){
            DB::table('users')->insert($u);
        }       
    }
}
