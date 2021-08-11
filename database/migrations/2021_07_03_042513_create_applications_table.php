<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->string('application_id');
            $table->string('fname');
            $table->string('lname');
            $table->string('place');
            $table->string('address');
            $table->string('phone');
            $table->string('aadhar');
            $table->string('ration');
            $table->decimal('amount');
            $table->string('status')->default('Pending');
            $table->string('reason')->nullable();
            $table->string('priority');
            $table->string('image');
            $table->string('file');
            $table->string('category');
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
        Schema::dropIfExists('applications');
    }
}
