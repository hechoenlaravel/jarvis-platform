<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EntityFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_entities_fields', function($table) {
            $table->increments('id');
            $table->integer('entity_id')->unsigned()->index();
            $table->string('namespace');
            $table->string('name');
            $table->text('description');
            $table->string('slug');
            $table->string('type');
            $table->text('options')->nullable();
            $table->string('default')->nullable();
            $table->boolean('required')->default(0);
            $table->boolean('locked')->default(0);
            $table->boolean('create_field')->default(0);
            $table->boolean('hidden')->default(0);
            $table->integer('order')->default(1);
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
        Schema::dropIfExists('app_entities_fields');
    }
}
