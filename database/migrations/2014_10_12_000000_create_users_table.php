<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {    
            $table->increments('id');
            $table->string('name');
            $table->string('phone',20)->unique();
            $table->string('username',100)->unique();
            $table->string('avatar',191)->default('');
            $table->string('address',191)->default('');
            $table->string('email',100)->unique();
            $table->timestamp('birthday')->nullable();            
            $table->timestamp('email_verified_at')->nullable();            
            $table->string('password',100); 
            $table->string('provider_id')->nullable();
            $table->string('provider')->nullable();
            $table->integer('group_id')->unsigned()->default(1);
            $table->integer('user_id')->unsigned()->default(0);
            $table->integer('status')->unsigned()->default(0);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
