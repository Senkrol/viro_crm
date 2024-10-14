<?php

namespace App\Rules\Statistics;

use Closure;
use App\Models\User;
use App\Models\Admin\Organizations\Organization;
use Illuminate\Contracts\Validation\ValidationRule;

class UniqueOrganizationAdmin implements ValidationRule
{
  /**
   * Run the validation rule.
   *
   * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
   */
  public function validate(string $attribute, mixed $value, Closure $fail): void
  {
  
    if (!count($value)) {
      $fail('удивительно но данных нет');
    }

    $organization = Organization::find($value['id']);
    if ($organization) {

      $user = User::where('email', '=', $organization->org_email)->get();
      if (count($user)) {
        $fail('Руководитель организации уже создан!');
      }
    } else {
      $fail('Данных нет');
    }
  }
}
