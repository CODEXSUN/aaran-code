<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (Aaran\Aadmin\Src\DbMigration::hasDeveloper()) {

            Schema::create('review_lists', function (Blueprint $table) {
                $table->id();
                $table->foreignId('review_filename_id')->references('id')->on('review_file_names')->onDelete('cascade');
                $table->foreignId('task_review_id')->references('id')->on('task_reviews')->onDelete('cascade');
                $table->smallInteger('completed')->default(0);
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('review_lists');
    }
};
