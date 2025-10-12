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
        Schema::table('schedule_statuses', function (Blueprint $table) {
            $table->string('background_color')->nullable()->after('name');
            $table->string('text_color')->nullable()->after('background_color');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('schedule_statuses', function (Blueprint $table) {
            $table->dropColumn('text_color');
            $table->dropColumn('background_color');
        });
    }
};
