<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebsiteUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('website_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('website_id');
            $table->unsignedBigInteger('user_id');

            $table->foreign('website_id')->references('id')->on('websites')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('website_user');
    }
}
