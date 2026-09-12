<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('announcements')) {
            Schema::table('announcements', function (Blueprint $table) {
                if (!Schema::hasColumn('announcements', 'priority')) {
                    $table->integer('priority')->default(0);
                }
            });
        }

        if (Schema::hasTable('achievements')) {
            Schema::table('achievements', function (Blueprint $table) {
                if (!Schema::hasColumn('achievements', 'category')) {
                    $table->string('category')->nullable();
                }
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('announcements')) {
            Schema::table('announcements', function (Blueprint $table) {
                if (Schema::hasColumn('announcements', 'priority')) {
                    $table->dropColumn('priority');
                }
            });
        }

        if (Schema::hasTable('achievements')) {
            Schema::table('achievements', function (Blueprint $table) {
                if (Schema::hasColumn('achievements', 'category')) {
                    $table->dropColumn('category');
                }
            });
        }
    }
};
