<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlowSavedPath extends Model
{
    use HasFactory;

    protected $connection = 'mysql2';
    protected $table = 'flow_saved_path';

    protected $fillable = ['flow_name', 'path', 'group_id'];
}
