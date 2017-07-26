<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    //
    protected $fillable = ['name', 'floor', 'building_id', 'phone', 'email', 'phone', 'email', 'unit'];
}
