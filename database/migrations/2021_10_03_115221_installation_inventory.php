<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InstallationInventory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('installation_inventory', function (Blueprint $table) {
            $table->foreignId("installation_id") ->constrained('installations')->cascadeOnDelete();
            $table->foreignId("inventory_id")
                ->constrained("inventories")->cascadeOnDelete();
            $table->integer("stock");
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
        Schema::dropIfExists('installation_inventory');
    }
}
