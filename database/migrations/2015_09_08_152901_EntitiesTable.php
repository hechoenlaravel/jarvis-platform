<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EntitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_entities', function($table){
            $table->increments('id');
            $table->string('namespace');
            $table->string('name');
            $table->string('slug');
            $table->text('description');
            $table->string('prefix');
            $table->string('table_name');
            $table->boolean('locked')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('app_entities');
    }
}
