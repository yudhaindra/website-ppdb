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
        Schema::table('registration_applications', function (Blueprint $table) {
            $table->string('proof_of_payment_filepath');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('registration_applications', function (Blueprint $table) {
            $table->dropColumn('proof_of_payment_filepath');
        });
    }
};
