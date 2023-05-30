<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApiWoocommerce extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'api_woocommerce';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'group_id', 
        'url',
        'client_id', 
        'client_secret', 
        'type', 
        'message', 
        'link_type', 
        'link_file', 
        'pending', 
        'failed', 
        'waiting', 
        'processing', 
        'completed', 
        'refunded', 
        'canceled'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at'];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;
}
