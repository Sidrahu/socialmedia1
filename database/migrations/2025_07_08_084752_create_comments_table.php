<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('comments', function (Blueprint $table) {
            if (! Schema::hasColumn('comments', 'parent_id')) {
                // parent_id ko comment column ke baad insert kar dein
                $table->unsignedBigInteger('parent_id')->nullable()->after('comment');

                // Foreign key self-reference
                $table->foreign('parent_id')
                    ->references('id')
                    ->on('comments')
                    ->onDelete('cascade');
            }
        });
    }

    public function down(): void
    {
        Schema::table('comments', function (Blueprint $table) {
            if (Schema::hasColumn('comments', 'parent_id')) {
                $table->dropForeign(['parent_id']);
                $table->dropColumn('parent_id');
            }
        });
    }
};
