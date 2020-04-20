<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockMovementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_movements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('stock_movement_type_id');
            $table->foreignId('product_id')->constrained();
            $table->decimal('amount', 8, 2);
            $table->foreignId('user_id')->constrained();
            $table->unsignedInteger('data_source_id');
            $table->timestamps();
            $table->softDeletes('deleted_at', 0);
            $table->foreign('stock_movement_type_id')->references('id')->on('stock_movement_types');
            $table->foreign('data_source_id')->references('id')->on('data_sources');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stock_movements');
    }
}
