<?php

namespace App\Models\Admin\DigitalSignatures;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DigitalSignature extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded= [];
}
