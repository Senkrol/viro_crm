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
    Schema::create('statistics_report_oo2', function (Blueprint $table) {
      $table->id();
      $table->timestamps();
      $table->unsignedBigInteger('organization_id');
      $table->foreign('organization_id')->references('id')->on('organizations');
      $table->integer('year');
      $table->text('step1')->nullable();
      $table->text('step2')->nullable();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('statistics_report_oo2');
  }
};
