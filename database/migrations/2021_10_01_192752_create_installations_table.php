<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstallationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('installations', function (Blueprint $table) {
            $table->id();
            $table->string("username")->nullable();
            $table->foreignId("package_id")
                ->references('id')
                ->on('packages')
                ->onDelete('cascade');
            $table->foreignId("user_id")
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->foreignId("technician_id")
                ->nullable()
                ->references('id')
                ->on('users')
                ->onDelete('restrict');
            $table->integer("installation_costs")->nullable();
            $table->integer("discount")->nullable();
            $table->integer("number_modem")->nullable();
            $table->string("port")->nullable();
            $table->string("status");
            $table->timestamp("expired")->nullable();
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
        Schema::dropIfExists('installations');
    }
}
