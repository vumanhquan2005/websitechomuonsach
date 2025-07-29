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
    Schema::create('borrow_records', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
        $table->foreignId('book_id')->constrained('books')->cascadeOnDelete();
        $table->timestamp('borrowed_at');
        $table->timestamp('due_date');
        $table->timestamp('returned_at')->nullable();
        $table->enum('status', ['borrowing', 'returned', 'late'])->default('borrowing');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('borrowrecords');
    }
};
