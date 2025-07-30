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
    DB::statement("ALTER TABLE borrow_records MODIFY COLUMN status ENUM('pending', 'approved', 'borrowing', 'returned', 'late', 'cancelled') NOT NULL DEFAULT 'pending'");
}

public function down(): void
{
    DB::statement("ALTER TABLE borrow_records MODIFY COLUMN status ENUM('borrowing', 'returned', 'late') NOT NULL DEFAULT 'borrowing'");
}

};
