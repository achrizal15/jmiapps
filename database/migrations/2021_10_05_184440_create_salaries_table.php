<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salaries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained("users", "id")
                ->cascadeOnDelete();
            $table->integer("balance");
            $table->integer("pay_cut")
                ->nullable();
            $table->integer("bonus")
                ->nullable();
            $table->string("note")
                ->nullable();
            $table->string("status")
                ->default("request");
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
        Schema::dropIfExists('salaries');
    }
}
