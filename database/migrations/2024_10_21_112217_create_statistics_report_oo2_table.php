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
      $table->json('step_1')->nullable();
      $table->json('step_2')->nullable();
      $table->json('step_3')->nullable();
      $table->json('step_4')->nullable();
      $table->json('step_5')->nullable();
      $table->json('step_6')->nullable();
      $table->json('step_7')->nullable();
      $table->json('step_8')->nullable();
      $table->json('step_9')->nullable();
      $table->json('step_10')->nullable();
      $table->json('step_11')->nullable();
      $table->json('step_12')->nullable();
      $table->json('step_13')->nullable();
      $table->json('step_14')->nullable();
      $table->json('step_15')->nullable();
      $table->json('step_16')->nullable();
      $table->json('step_17')->nullable();
      $table->json('step_18')->nullable();
      $table->json('step_19')->nullable();
      $table->json('step_20')->nullable();
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
