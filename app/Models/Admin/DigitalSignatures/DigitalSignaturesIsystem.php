<?php

namespace App\Models\Admin\DigitalSignatures;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DigitalSignaturesIsystem extends Model
{
    use HasFactory;
    use SoftDeletes;


    //protected $table = 'eds_isys';
    protected $guarded= false;


}
