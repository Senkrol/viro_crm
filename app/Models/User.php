<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Notifications\CustomResetPassword;
use App\Notifications\CustomVerification;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

// implements MustVerifyEmail обязательное подтверждение почты
class User extends Authenticatable implements MustVerifyEmail
{
  use HasFactory, Notifiable, SoftDeletes;

  /**
   * Атрибуты, которые можно массово присваивать.
   * то что разрешено для изменения в базе, с одной стороны надо бы что то заполнить
   * но лучше уж сделаю протектед на действительно нужное
   *
   * @var array<int, string>
   */
  /*
  protected $fillable = [
    'surname',
    'name',
    'patronymic',
    'snils',
    'email',
    'password',
  ];
*/
protected $guarded= [];

  /**
   * Атрибуты, которые должны быть скрыты для сериализации.
   *
   * @var array<int, string>
   */
  protected $hidden = [
    'password',
    'remember_token',
  ];

  /**
   * Получите атрибуты, которые должны быть приведены в действие.
   *
   * @return array<string, string>
   */
  protected function casts(): array
  {
    return [
      'email_verified_at' => 'datetime',
      'password' => 'hashed',
    ];
  }

  /**
   * Send the email verification notification.
   *
   * @return void
   * хитро забрали из vendor - laravel- framework - src -illuminate - auth - mustVerifyEmail.php
   */
  public function sendEmailVerificationNotification()
  {
    $this->notify(new CustomVerification);
  }


  /**
   * Send the password reset notification.
   *
   * @param  string  $token
   * @return void
   * хитро забрали из vendor - laravel- framework - src -illuminate - auth - passwords - canresetpassword.php
   */
  public function sendPasswordResetNotification(#[\SensitiveParameter] $token)
  {
    $this->notify(new CustomResetPassword($token));
  }
}
