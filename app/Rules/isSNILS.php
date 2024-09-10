<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class isSNILS implements ValidationRule
{
  /**
   * Run the validation rule.
   *
   * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
   */
  public function validate(string $attribute, mixed $value, Closure $fail): void
  {
    $result = false;

    $snils = (string) $value;
    if (!$snils) {
      $fail('СНИЛС пуст');
    } elseif (preg_match('/[^0-9]/', $snils)) {
      $fail('СНИЛС может состоять только из цифр');
    } elseif (strlen($snils) !== 11) {
      $fail('СНИЛС может состоять только из 11 цифр');
    } else {
      $sum = 0;
      for ($i = 0; $i < 9; $i++) {
        $sum += (int) $snils[$i] * (9 - $i);
      }
      $check_digit = 0;
      if ($sum < 100) {
        $check_digit = $sum;
      } elseif ($sum > 101) {
        $check_digit = $sum % 101;
        if ($check_digit === 100) {
          $check_digit = 0;
        }
      }

      if ($check_digit === (int) substr($snils, -2)) {
        $result = true; // финальная проверка по контрольному числу
      } 
    }





    if (!$result) {
      $fail('Опа а снилс то паленый!');
    }
  }
}
