<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title', 70)->index();
            $table->string('slug', 50)->unique();
            $table->text('image');
            $table->text('summary');
            $table->text('body');
            $table->bigInteger('visits')->default(1);
            $table->boolean('is_active')->default(false)->index();
            $table->timestamp('published_at')->nullable();
            $table->string('meta_title', 60);
            $table->string('meta_description', 160);
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('article_category_id')->constrained('article_categories')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
