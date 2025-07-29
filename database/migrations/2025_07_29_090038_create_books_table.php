<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up(): void
{
    Schema::create('books', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->string('author');
        $table->text('description')->nullable();
        $table->foreignId('category_id')->nullable()->constrained('categories')->nullOnDelete();
        $table->string('cover_image')->nullable();
        $table->integer('quantity')->default(1);
        $table->integer('available')->default(1);
        $table->year('published_year')->nullable();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
