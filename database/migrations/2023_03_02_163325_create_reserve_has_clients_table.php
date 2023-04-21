<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reserve_has_clients', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('reserve_id')->onDelete('cascade');
            $table->foreign('reserve_id')->references('id')->on('reserves');
            $table->unsignedBigInteger('client_id')->onDelete('cascade');
            $table->foreign('client_id')->references('id')->on('clients');
            $table->softDeletes();
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
        Schema::dropIfExists('reserve_has_clients');
    }
};
