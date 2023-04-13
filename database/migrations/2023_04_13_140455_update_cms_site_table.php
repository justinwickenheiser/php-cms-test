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
        Schema::table('cms_site', function (Blueprint $table) {
            $table->boolean('show_title')->default(true);
            $table->boolean('show_content_title')->default(true);
        });
        Schema::table('cms_site', function (Blueprint $table) {
            $table->dropColumn('hide_title');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cms_site', function (Blueprint $table) {
            $table->boolean('hide_title')->default(false);
        });
        Schema::table('cms_site', function (Blueprint $table) {
            $table->dropColumn('show_title');
            $table->dropColumn('show_content_title');
        });
    }
};
