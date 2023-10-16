<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use DB;
use Illuminate\Support\Facades\Hash;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        $groupId= DB::table('groups')->insertGetId([
            'name' => 'Administrator',  
            'user_id' => 0,
            'permissions' => '{"Users":["view","create","update","delete"],"Groups":["view","create","update","delete","permission"],"Post":["view","create","update","delete"],"Modules":["view","create","update","delete"],"Product":["view","create","update","delete"]}',
            'created_at' =>date('Y-m-d H:i:s'),
            'updated_at' =>date('Y-m-d H:i:s')
        ]);
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

       if($groupId > 0) {        
        $userId= DB::table('users')->insertGetId([
            'name' => 'Tu Ngoc Van',
            'email' => 'tungocvan@gmail.com',
            'avatar' => '/images/avatar.jpg',
            'phone' => '0903971949',
            'username' => 'tungocvan',
            'password' => Hash::make('123456'),
            'group_id' => $groupId,
            'user_id' => 0,
            'status' => 1,
            'provider' =>'website',
            'created_at' =>date('Y-m-d H:i:s'),
            'updated_at' =>date('Y-m-d H:i:s')
        ]);
        DB::table('modules')->insert([
            'name' => 'Users',
            'title' => "Quản lý người dùng",                 
            'created_at' =>date('Y-m-d H:i:s'),
            'updated_at' =>date('Y-m-d H:i:s')
            ]);
           DB::table('modules')->insert([
            'name' => 'Groups',
            'title' => "Quản lý nhóm",                 
            'created_at' =>date('Y-m-d H:i:s'),
            'updated_at' =>date('Y-m-d H:i:s')
            ]);
           DB::table('modules')->insert([
            'name' => 'Post',
            'title' => "Quản lý Bài viết",                 
            'created_at' =>date('Y-m-d H:i:s'),
            'updated_at' =>date('Y-m-d H:i:s')
            ]);
           DB::table('modules')->insert([
            'name' => 'Product',
            'title' => "Quản lý Sản phẩm",                 
            'created_at' =>date('Y-m-d H:i:s'),
            'updated_at' =>date('Y-m-d H:i:s')
            ]);
       }
       DB::table('groups')->insert([
        'name' => 'Manager', 
        'permissions' => '{"Users":["view","create"],"Groups":["view"],"Post":["view","create","update","delete"],"Modules":["view","create","update","delete"],"Product":["view","create","update","delete"]}',
        'user_id' => $userId,
        'created_at' =>date('Y-m-d H:i:s'),
        'updated_at' =>date('Y-m-d H:i:s')
        ]);
        DB::table('groups')->insert([
            'name' => 'Users', 
            'user_id' => $userId,
            'permissions' => '{"Post":["view","create","update","delete"],"Product":["view","create","update","delete"]}',
            'created_at' =>date('Y-m-d H:i:s'),
            'updated_at' =>date('Y-m-d H:i:s')
        ]);
        DB::table('groups')->insert([
            'name' => 'Guest', 
            'user_id' => $userId,
            'permissions' => '{"Post":["view"],"Product":["view"]}',
            'created_at' =>date('Y-m-d H:i:s'),
            'updated_at' =>date('Y-m-d H:i:s')
        ]);
    
    }
}
