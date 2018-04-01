<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('items', function($table){
        $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
      });

      Schema::table('transactions', function($table){
        $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
        $table->foreign('customer_id')->references('id')->on('users')->onDelete('cascade');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
