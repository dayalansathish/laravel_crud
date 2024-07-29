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
        Schema::table('table_sample', function (Blueprint $table) {
            $table->unsignedTinyInteger('version')->default(0);
            $table->unsignedMediumInteger('other_user_count')->default(0);
            $table->string('admin')->default('user');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('table_sample', function (Blueprint $table) {
            $table->dropColumn('version','other_user_count','admin');
        });
    }
};
