<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderItemsTable extends Migration
{
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('imdbID');
            $table->string('Poster');
            $table->string('Title');
            $table->string('Type');
            $table->string('Year');
            $table->string('Status');
            $table->decimal('Price', 8, 2); 
            $table->timestamps();
            $table->unique(['user_id', 'imdbID']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('order_items');
    }
}
