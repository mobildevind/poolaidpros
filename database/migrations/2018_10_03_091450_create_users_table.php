<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->enum('role_id', [1,2,3,4])->comment('[1 => "Admin",2 => "Company" ,3 => "Service_Technicians,4 => "Customer"]');
             $table->string('first_name');
              $table->string('last_name');
            $table->string('user_name');
            $table->string('email');
            $table->string('mobile');
            $table->string('password');
            $table->string('image');
            $table->text('bio');
            $table->enum('is_active', ['Y','N'])->default('Y')->comment('[Y => "Yes",N => "No"]');
            $table->enum('is_delted', ['0','1'])->default('0')->comment('[1 => "1",0 => "0"]');
            $table->string('device_type');
            $table->string('device_token');
            $table->rememberToken();
            $table->dateTime('created')->useCurrent();
            $table->timestamp('updated')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
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
