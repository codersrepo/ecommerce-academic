<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_translations', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('summary');
            $table->string('description');
            $table->integer('price');
            $table->string('brand_name');
            $table->integer('discount_percent');
            $table->string('locale')->index();
            // $table->foreignId('category_id')->nullable()->constrained('categories', 'id')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreignId('product_id')->nullable()->constrained('products', 'id')->onDelete('CASCADE')->onUpdate('CASCADE');
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
        Schema::dropIfExists('product_translations');
    }
}
