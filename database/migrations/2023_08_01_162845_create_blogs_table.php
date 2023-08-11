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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("category_id");
            $table->string("title",255);
            $table->string("slug",255);
            $table->string("fragment",255);
            $table->string("image",255);
            $table->integer("status")->default(0)->comment("1.Aktif;2.Tidak Aktif");
            $table->timestamps();
            $table->softDeletes();

            $table->foreign("category_id")
                ->references("id")
                ->on("blog_categories")
                ->onDelete("cascade")
                ->onUpdate("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
