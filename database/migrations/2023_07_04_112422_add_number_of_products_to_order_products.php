<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNumberOfProductsToOrderProducts extends Migration
{
    public function up()
    {
        Schema::table('order_products', function (Blueprint $table) {
            $table->integer('number_of_products')->default(1);
        });
    }

    public function down()
    {
        Schema::table('order_products', function (Blueprint $table) {
            $table->dropColumn('number_of_products');
        });
    }
}
