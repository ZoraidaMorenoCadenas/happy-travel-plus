<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cards', function (Blueprint $table) {
           
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->text('description')->limit(500);
            $table->string('title');
            $table->string('location');
            $table->string('image');
            $table->timestamps();
           
           
            /* modelo card original
            $table->id();
            $table->string('image');
            $table->string('title');
            $table->string('location');  
            $table->string('description');  
            $table->timestamps();*/
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cards');
    }
}
