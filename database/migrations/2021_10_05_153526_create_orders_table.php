<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('address');
            $table->string('district');
            $table->foreignId('cart_id')->nullable()->constrained('carts','id')->onDelete('SET NULL')->onUpdate('CASCADE');
            $table->foreignId('user_id')->nullable()->constrained('users','id')->onDelete('SET NULL')->onUpdate('CASCADE');
            $table->enum('status',['delivered','new'])->default('new');
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
        Schema::dropIfExists('orders');
    }
}
