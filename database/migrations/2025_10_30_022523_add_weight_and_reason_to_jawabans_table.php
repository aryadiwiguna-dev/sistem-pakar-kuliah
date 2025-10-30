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
        Schema::table('jawabans', function (Blueprint $table) {
            $table->integer('weight')->default(1)->after('bobot');
            $table->text('conclusion_reason')->nullable()->after('weight');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jawabans', function (Blueprint $table) {
            $table->dropColumn('weight');
            $table->dropColumn('conclusion_reason');
        });
    }
};
