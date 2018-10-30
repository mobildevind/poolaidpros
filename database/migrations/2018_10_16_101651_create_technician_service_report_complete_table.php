<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTechnicianServiceReportCompleteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('technician_service_report_complete', function (Blueprint $table) {
                $table->increments('id');
                $table->string('c_id');
                $table->string('tec_id');
                $table->string('cus_id');
                $table->string('service_report_type_id');
                $table->string('service_report_subtype_id');
                $table->string('service_report_value');
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
        Schema::dropIfExists('technician_service_report_complete');
    }
}
