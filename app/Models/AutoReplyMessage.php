<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AutoReplyMessage extends Model
{
    use HasFactory;

    protected $connection = 'mysql2';
    protected $table = 'auto_reply_messages';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];
    public $timestamps = false;

    public function parent()
    {
        return $this->belongsTo('App\Models\AutoReplyMessage','replyid')->where('replyid',0)->with('parent');
    }

    public function children()
    {
        return $this->hasMany('App\Models\AutoReplyMessage','replyid')->with('children')->orderBy('order_num', 'asc');
    }
}
