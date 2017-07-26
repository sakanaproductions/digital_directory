<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Spatie\Permission\Traits\HasRoles;

class Building extends Model
{
    //
    use SoftDeletes, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','address1','address2','city','state','postal_code','floors','has_image','owner_id'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Buildings belong to owners (user)
     *
     */
    public function owner()
    {
        return $this->belongsTo('App\User','owner_id');
    }

    /**
     * Buildings can save tenants
     *
     * @var App\Tenant
     */
    public function addTenant($tenants)
    {
        $method = $tenants instanceof Tenant ? "save" : "saveMany";

        return $this->tenants()->$method($tenants);
    }

    /**
     * Buildings have tenants
     *
     */
    public function tenants()
    {
        return $this->hasMany('App\Tenant')->orderBy('floor');
    }
}
