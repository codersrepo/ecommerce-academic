<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacilityTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facility_translations', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->foreignId('language_id')->nullable()->constrained('languages')->onDelete("SET NULL");
            $table->foreignId('facility_id')->nullable()->constrained('facilities')->onDelete("CASCADE");
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
        Schema::dropIfExists('facility_translations');
    }
}
