<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class role extends Model
{
    protected $guarded = [
        'created_at','updated_at',
     ];
     public $primaryKey = 'id_role';
     public $incrementing = false;
}
