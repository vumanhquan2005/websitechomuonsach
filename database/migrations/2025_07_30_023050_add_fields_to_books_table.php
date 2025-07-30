<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->string('isbn')->nullable()->after('title');
            $table->string('slug')->nullable()->after('isbn');
            $table->string('publisher')->nullable()->after('author');
            $table->string('language', 50)->nullable()->after('publisher');
            $table->integer('pages')->nullable()->after('language');
            $table->tinyInteger('status')->default(1)->after('available'); // 1: hiển thị, 0: ẩn
            $table->unsignedBigInteger('created_by')->nullable()->after('status');
            $table->softDeletes(); // deleted_at
        });
    }

    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->dropColumn([
                'isbn',
                'slug',
                'publisher',
                'language',
                'pages',
                'status',
                'created_by',
                'deleted_at'
            ]);
        });
    }
};
