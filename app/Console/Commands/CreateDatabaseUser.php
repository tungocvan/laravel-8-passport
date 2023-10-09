<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class CreateDatabaseUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:make {number}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */ 
    public function handle()
    {
        $number = $this->argument('number');
        if(is_numeric($number)){
            for ($i=0; $i <$number ; $i++) { 
                $faker = Faker::create();
                $name = $faker->name;
                $email = $faker->email;
                $username  = Str::beforeLast($email, '@');                        
                DB::table('users')->insertGetId([
                    'name' => $name,
                    'username' => $username,
                    'email' => $email,
                    'password' => Hash::make('123456'),
                    'group_id' => rand(2, 4),
                    'user_id' => 1,
                    'provider' =>'test',
                    'status' => rand(0, 1),
                    'avatar' => '/images/avatar.jpg',
                    'created_at' =>date('Y-m-d H:i:s'),
                    'updated_at' =>date('Y-m-d H:i:s')
                ]);     
            }
            return $this->info("Đã thêm dữ liệu mẫu vào database");
        }
        return $this->info("Đây không phải là số");
    }
}
