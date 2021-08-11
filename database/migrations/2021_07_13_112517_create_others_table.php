<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOthersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('others', function (Blueprint $table) {
            $table->id();
            $table->string('application_id');
            $table->string('fname');
            $table->string('lname');
            $table->string('place');
            $table->string('address');
            $table->decimal('amount');
            $table->string('status')->default('Pending');
            $table->string('reason')->nullable();
            $table->string('priority');
            $table->string('image');
            $table->string('ref_file');
            $table->string('file');
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
        Schema::dropIfExists('others');
    }
}
