<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApiHotmart extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'api_hotmart';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'groupid',
        'token',
        'type',
        'message',
        'link_type',
        'link_file',
        'billet',
        'approved',
        'completed',
        'delay',
        'refunded',
        'expired',
        'canceled',
        'chargeback',
        'dispute',
        'abandoned',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
    ];
}
