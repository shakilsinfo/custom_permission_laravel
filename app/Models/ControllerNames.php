<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ControllerNames extends Model
{
    protected $table = 'controller_name';
    protected $fillable = ['full_name','surname'];
}
