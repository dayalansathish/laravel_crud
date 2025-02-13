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
        Schema::table("table_sample", function (Blueprint $table) {
            $table->renameColumn("admin","admin_role");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table("table_sample", function (Blueprint $table) {
            $table->renameColumn("admin_role","admin");
        });
    }
};
