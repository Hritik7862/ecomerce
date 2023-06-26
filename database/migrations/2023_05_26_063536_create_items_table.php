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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            
            // $table->unsignedBigInteger('id');
        $table->string('itemName');
    $table-> integer('itemQuantity');
    $table -> string('itemType');
    $table -> string('itemImage');
    $table -> string('description');
    $table->integer('PurchasingPrice');
    $table->integer('SellingPrice');
    // $table -> integer('PurchasingPrice');
    //  $table -> integer('SellingPrice');
    //$table ->dropColumn('MobileNumber');
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
        Schema::dropIfExists('items');
    }
};
