<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPromotionIdToOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_details', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('promotion_id')->nullable();

            // set foreign key
            $table->foreign('promotion_id')->references('id')->on('promotions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_details', function (Blueprint $table) {
            //
            $table->dropColumn('promotion_id');

            // DROP foreign key for table order_details (order_details.promotion_id = promotions.id)
            if (Schema::hasColumn('order_details', 'promotion_id') && Schema::hasTable('promotions')) {
                Schema::table('order_details', function (Blueprint $table) {
                    $table->dropForeign(['promotion_id']);
                });
            }
        });
    }
}
