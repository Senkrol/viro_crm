<?php

namespace App\Models\Admin\VIRO;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VIRODepartment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'viro_departments';
}
