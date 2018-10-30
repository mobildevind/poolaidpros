<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceReportSubtypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_report_subtype', function (Blueprint $table) {
           $table->increments('id');
            $table->increments('r_id');
            $table->string('name');
            $table->enum('filed_type', ['dropdown','textbox','checkbox','redio'])->default('textbox');
            $table->enum('status', ['Y','N'])->default('Y')->comment('[Y => "Yes",N => "No"]');
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
        Schema::dropIfExists('service_report_subtype');
    }
}
