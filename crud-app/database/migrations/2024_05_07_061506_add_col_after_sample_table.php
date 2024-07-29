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
            $table->unsignedTinyInteger('version')->default(0)->after('more_details');
            $table->string('admin_role',15)->default('user')->after('version');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('table_sample', function (Blueprint $table) {
            $table->dropColumn('version','admin_role');
        });
    }
};
