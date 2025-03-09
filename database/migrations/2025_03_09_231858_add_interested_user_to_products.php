<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up() {
        Schema::table('products', function (Blueprint $table) {
            $table->foreignId('interested_user_id')->nullable()->constrained('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down() {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['interested_user_id']);
            $table->dropColumn('interested_user_id');
        });
    }
};
