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
        Schema::create('debts', function (Blueprint $table) {
            $table->id();
            $table->string('nama'); // nama orang
            $table->decimal('jumlah', 15, 2); // jumlah utang
            $table->text('keterangan')->nullable(); // opsional
            $table->date('tanggal'); // tanggal utang
            $table->boolean('status')->default(0); // 0 = belum lunas, 1 = lunas
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('debts');
    }
};
