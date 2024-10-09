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
    Schema::table('organizations', function (Blueprint $table) {
      $table->string('okpo')->nullable()->after('inn');
      $table->string('kpp')->nullable()->after('okpo');
      $table->string('ogrn')->nullable()->after('kpp');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::table('organizations', function (Blueprint $table) {
      $table->dropColumn('okpo');
      $table->dropColumn('kpp');
      $table->dropColumn('ogrn');
    });
  }
};
