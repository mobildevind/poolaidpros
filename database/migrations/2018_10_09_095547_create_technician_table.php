<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTechnicianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('technician', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('u_id');
            $table->string('name');
            $table->string('country_code');
            $table->string('phone');
            $table->string('scountry_code');
            $table->string('sphone');
            $table->string('email');
            $table->text('address');
            $table->string('image');
            $table->string('salary');
            $table->string('salary_recurrency');
            $table->text('about');
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
        Schema::dropIfExists('technician');
    }
}
