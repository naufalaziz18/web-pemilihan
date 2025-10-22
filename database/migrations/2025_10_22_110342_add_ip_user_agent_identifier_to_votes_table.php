<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('votes', function (Blueprint $table) {
            if (!Schema::hasColumn('votes', 'ip')) {
                $table->string('ip', 45)->nullable()->after('identifier');
            }
            if (!Schema::hasColumn('votes', 'user_agent')) {
                $table->text('user_agent')->nullable()->after('ip');
            }
        });
    }


    public function down(): void
    {
        Schema::table('votes', function (Blueprint $table) {
            $table->dropColumn(['ip', 'user_agent']);
        });
    }

};
