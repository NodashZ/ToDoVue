<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Todo extends Model
{
    //テーブル名と紐付け
    protected $table = 'todos';
    
    protected $guarded = array('id');

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
