<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

abstract class BaseModel
{
    use SoftDeletes;
}