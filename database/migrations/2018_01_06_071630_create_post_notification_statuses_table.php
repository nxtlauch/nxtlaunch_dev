<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostNotificationStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_notification_statuses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('post_id')->unsigned();
            $table->tinyInteger('seven_days_reminder')->default(0);
            $table->tinyInteger('one_day_reminder')->default(0);
            $table->tinyInteger('one_hour_reminder')->default(0);
            $table->tinyInteger('five_minutes_reminder')->default(0);
            $table->timestamps();
            $table->foreign('post_id')
                ->references('id')->on('posts')
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
        Schema::dropIfExists('post_notification_statuses');
    }
}
