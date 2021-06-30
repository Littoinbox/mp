<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_history', function (Blueprint $table) {
            $table->id();
            $table->integer('id_item');
            $table->text('name');
            $table->float('price');
            $table->float('old_price')->nullable(true);
            $table->float('count_stars')->nullable(true);
            $table->float('count_comments')->nullable(true);
            $table->float('count_buy')->nullable(true);
            $table->text('description')->nullable(true);
            $table->text('images')->nullable(true);
            $table->text('count_prop')->nullable(true);
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
        Schema::dropIfExists('item_history');
    }
}
