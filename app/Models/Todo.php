<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    //テーブル名と紐付け
    protected $table = 'todos';
    
    protected $guarded = array('id');

}
