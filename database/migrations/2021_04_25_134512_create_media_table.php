<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMediaTable extends Migration
{
    public function up()
    {
        Schema::create('media', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('ads_id')->constrained('ads')->onDelete('cascade');
            $table->string('url');
            $table->timestamps();
        });
    }

     public function down()
    {
        Schema::dropIfExists('media');
    }
}
