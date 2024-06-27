<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (Aaran\Aadmin\Src\DbMigration::hasDeveloper()) {

            Schema::create('actions', function (Blueprint $table) {
                $table->id();
                $table->foreignId('modals_id')->references('id')->on('modals')->onDelete('cascade');
                $table->foreignId('test_file_id')->references('id')->on('test_files')->onDelete('cascade');
                $table->string('vname')->nullable();
                $table->string('active_id', 3)->nullable();
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('actions');
    }
};