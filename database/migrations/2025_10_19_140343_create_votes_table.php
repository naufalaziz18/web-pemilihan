<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('votes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('candidate_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null'); // kalau terdaftar
            $table->string('identifier')->nullable(); // session id / cookie / ip+ua hash
            $table->string('ip')->nullable();
            $table->text('user_agent')->nullable();
            $table->timestamps();

            // Optional: mencegah double vote dari identifier yang sama per kandidat
            $table->unique(['candidate_id', 'identifier']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('votes');
    }
};
