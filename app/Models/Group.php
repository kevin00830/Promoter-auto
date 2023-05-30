<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Group extends Authenticatable
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     */
    protected $fillable = [
        'gp_groupname',
        'password',
        'gp_temp_psw', // added temporarily, remove this on production
        'gp_status',
        'gp_company',
        'gp_cc',
        'gp_ac',
        'gp_country_id',
        'gp_country_name',
        'gp_wpp_group_id',
        'gp_state',
        'gp_city',
        'gp_district',
        'gp_address',
        'gp_zip',
        'gp_legal_name',
        'gp_legal_id',
        'gp_plan',
    ];

    /**
     * Get the users in group.
     */
}
