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
        Schema::table('activities', function (Blueprint $table) {
            $table->string('code', 30)->nullable()->unique()->after('category_id');
            $table->string('location', 150)->nullable()->after('description');
            $table->integer('capacity')->default(0)->after('location');
            $table->datetime('start_at')->nullable()->after('activity_date');
            $table->datetime('end_at')->nullable()->after('start_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('activities', function (Blueprint $table) {
            $table->dropColumn(['code', 'location', 'capacity', 'start_at', 'end_at']);
        });
    }
};
