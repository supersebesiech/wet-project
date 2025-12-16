<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EnsureLocaleOnUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Only add the column if it does not already exist. This is safe
        // for SQLite/MySQL/Postgres.
        if (!Schema::hasColumn('users', 'locale')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('locale', 10)->default('en');
            });
        } else {
            // If the column exists but has no default, try to set default.
            // Note: altering default on SQLite may not be supported via change();
            // but Laravel will attempt; if it fails, you can recreate table manually.
            try {
                Schema::table('users', function (Blueprint $table) {
                    $table->string('locale', 10)->default('en')->change();
                });
            } catch (\Exception $e) {
                // Changing column defaults on SQLite sometimes fails; ignore here.
                \Log::info('EnsureLocaleOnUsersTable: could not change locale default on this platform: ' . $e->getMessage());
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('users', 'locale')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('locale');
            });
        }
    }
}
