<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFlowsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fl_flows', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->boolean('active')->default(0)->index();
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('fl_flows_steps', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('flow_id')->unsigned();
            $table->string('name');
            $table->text('description')->nullable();
            $table->integer('order')->default(1)->index();
            $table->boolean('is_last')->default(0)->index();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('flow_id')->references('id')->on('fl_flows')->onDelete('cascade');
        });
        Schema::create('fl_flows_steps_transitions', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('flow_id')->unsigned();
            $table->integer('step_from_id')->unsigned();
            $table->integer('step_to_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('flow_id')->references('id')->on('fl_flows')->onDelete('cascade');
            $table->foreign('step_from_id')->references('id')->on('fl_flows_steps')->onDelete('cascade');
            $table->foreign('step_to_id')->references('id')->on('fl_flows_steps')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('fl_flows_steps_transitions');
        Schema::drop('fl_flows_steps');
        Schema::drop('fl_flows');
    }

}
