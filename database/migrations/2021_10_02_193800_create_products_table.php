<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->enum('status',['active','inactive'])->default('inactive');
            $table->string('image_icon')->nullable();
            $table->string('slug');
            $table->string('size');
            $table->integer('price');
            $table->string('colour');
            $table->string('product_code');
            $table->boolean('is_featured')->nullable()->default(false);
            $table->foreignId('category_id')->nullable()->constrained('categories','id')->onDelete('SET NULL')->onUpdate('CASCADE');
            $table->softDeletes();
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
        Schema::dropIfExists('products');
    }
}
