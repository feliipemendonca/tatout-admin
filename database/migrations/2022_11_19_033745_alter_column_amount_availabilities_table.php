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
        Schema::table('availabilities', function (Blueprint $table) {
            $table->float('amount', 8, 2)->nullable()->change();
            $table->unsignedBigInteger('status_id')->after('id');
            $table->foreign('status_id')->references('id')->on('statuses');

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
        Schema::table('availabilities', function (Blueprint $table) {
            $table->float('amount')->nullable()->change();
            $table->dropForeign(['status_id']);
            $table->dropColumn('status_id');

            $table->dropForeign(['type_price_id']);
            $table->dropColumn('type_price_id');
        });
    }
};
