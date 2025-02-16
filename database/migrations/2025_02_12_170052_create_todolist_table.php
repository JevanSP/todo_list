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
        Schema::create('todolist', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->enum('status', ['belum selesai', 'selesai'])->default('belum selesai');
            $table->enum('prioritas', ['rendah', 'sedang', 'tinggi']); 
            $table->datetime('tgl_ditambahkan')->useCurrent();       
            $table->datetime('tgl_ditandai')->nullable(); 
            $table->timestamps();
        }); 
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('todolist');
    }
};
