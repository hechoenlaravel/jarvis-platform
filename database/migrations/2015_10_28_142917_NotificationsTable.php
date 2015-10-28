<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_notifications', function($table)
        {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('type');
            $table->text('message');
            $table->string('link')->nullable();
            $table->datetime('readed_at')->nullable()->default(null);
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
        Schema::drop('app_notifications');
    }
}
