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
        Schema::table('product_prices', function (Blueprint $table) {
            $table->dropColumn('age');
            $table->unsignedBigInteger('type_price_id')->after('id');
            $table->foreign('type_price_id')->references('id')
                ->on('type_prices')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_prices', function (Blueprint $table) {
            $table->dropForeign(['type_price_id']);
            $table->dropColumn('type_price_id');
            $table->string('age')->after('status');
        });
    }
};
