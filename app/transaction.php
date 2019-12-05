<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class transaction extends Model
{
    protected $guarded = [
        'created_at','updated_at'
     ];
     public $primaryKey = 'id_trans';
     public $incrementing = false;
}
