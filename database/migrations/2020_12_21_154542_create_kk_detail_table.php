<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKkDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kkdetail', function (Blueprint $table) {
            $table->id();
            $table->string('kk_id');
            $table->string('nik')->unique();
            $table->string('name');
            $table->string('place_of_birth');
            $table->date('dob');
            $table->string('position');
            $table->integer('status')->default(1);
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
        Schema::dropIfExists('kk_detail');
    }
}
