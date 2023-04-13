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
        Schema::create('cms_content', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->foreignId('site_id')->constrained('cms_site');
            $table->string('title');
            $table->string('slug');
            $table->boolean('is_homepage')->default(false);
            $table->boolean('is_internal')->default(false);
            $table->boolean('show_problem')->default(true);
            $table->text('description')->nullable();
            $table->string('meta_title')->nullable();
            $table->timestamp('start_date')->nullable();
            $table->timestamp('end_date')->nullable();
            $table->string('header_type')->default('default');
            $table->string('admin')->nullable();

            $table->text('content')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cms_content');
    }
};
