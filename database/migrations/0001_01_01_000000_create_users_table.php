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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('surname'); // фамилия
            $table->string('name'); //имя
            $table->string('patronymic'); // отчество
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password'); 

            $table->boolean('isAdmin')->default(0);
            $table->string('possibilitys')->default('user');  // разрешения, в основном для админов
            
            $table->string('phone')->nullable();
            $table->string('snils')->unique()->nullable(); 
            $table->unsignedBigInteger('nationality_id')->nullable(); // id - национальности
            $table->unsignedBigInteger('sex')->nullable(); // id - гендер
            $table->date('birthday')->nullable();  
            $table->unsignedBigInteger('education_id')->nullable();// id - тип образования
            $table->string('dolgnost')->nullable(); // некий массив id`шников
             
            $table->unsignedBigInteger('organization_region_id')->nullable(); // id - область вологодская там или московия
            $table->unsignedBigInteger('organization_district_id')->nullable(); // id - округ или район  
            $table->unsignedBigInteger('organization_type_id')->nullable(); // id - тип организации
            $table->unsignedBigInteger('organization_id')->nullable(); // id - конкретная организация

            $table->unsignedBigInteger('viro_department')->nullable(); // id нашинских отделов
            $table->text('viro_dolgnost')->nullable(); // должности в виро
                
            $table->string('diplom_seria')->nullable();
            $table->string('diplom_nomer')->nullable();
            $table->string('diplom_fam')->nullable();
      
            $table->boolean('isFullInfo')->default(0); // полнота учетных данных

            $table->date('last_entry')->nullable(); // дата и время последнего входа
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
