<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::table('borrow_records', function (Blueprint $table) {
        $table->text('notes')->nullable()->after('status');
        $table->timestamp('approved_at')->nullable()->after('approved_by');
        $table->softDeletes(); // Tự động thêm cột deleted_at
    });
}

public function down()
{
    Schema::table('borrow_records', function (Blueprint $table) {
        $table->dropColumn(['notes', 'approved_at', 'deleted_at']);
    });
}

};
