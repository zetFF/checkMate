<?php

// Mengimpor class yang diperlukan
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Mendefinisikan class migration
return new class extends Migration
{
    // Method untuk membuat tabel
    public function up(): void
    {
        Schema::create('todos', function (Blueprint $table) {
            // Field-field dalam tabel todos
            $table->id(); // Primary key
            $table->string('name'); // Nama todo
            $table->text('description'); // Deskripsi todo
            $table->enum('priority', ['low', 'medium', 'high']); // Prioritas todo
            $table->dateTime('due_date'); // Tanggal deadline
            $table->boolean('is_completed')->default(false); // Status penyelesaian
            $table->timestamps(); // created_at dan updated_at
        });
    }

    // Method untuk menghapus tabel
    public function down(): void
    {
        Schema::dropIfExists('todos');
    }
};