<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tower_id')->unsigned();
            $table->string('name');
            $table->string('leave_apply_span')->nullable();
            $table->string('contract_span')->nullable();
            $table->string('manage_code')->nullable();
            $table->string('memo')->nullable();
            $table->timestamps();

            $table->foreign('tower_id')
                ->references('id')
                ->on('towers')
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
        Schema::dropIfExists('rooms');
    }
}
