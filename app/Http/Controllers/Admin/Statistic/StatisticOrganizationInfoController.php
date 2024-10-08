<?php

namespace App\Http\Controllers\Admin\Statistic;

use App\Http\Controllers\Controller;
use App\Models\Admin\Organizations\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class StatisticOrganizationInfoController extends Controller
{
  public function index()
  {

    $admin = Auth::user();

    $organization = Organization::select(
      'organizations.id',
      'organizations.code_OU',
      'organizations.full_name',
      'organizations.short_name',
      'organizations.village_city',
      'organizations.postal_address',
      'organizations.director_surname',
      'organizations.director_name',
      'organizations.director_patronymic',
      'organizations.inn',
      'organizations.org_phone',
      'organizations.org_email',
      'organizations_regions.region_title',
      'organizations_districts.district_title',
    )
      ->where('organizations.id', '=', $admin['organization_id'])
      ->leftJoin('organizations_regions', 'organizations_regions.id', '=', 'organizations.organization_region_id')
      ->leftJoin('organizations_districts', 'organizations_districts.id', '=', 'organizations.organization_district_id')
      ->get();

    return inertia('Admin/Statistics/OrganizationInfo', [
      'organization' => $organization[0],

    ]);
  }
}
