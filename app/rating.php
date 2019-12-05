<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class rating extends Model
{
    protected $guarded = [
        'created_at','updated_at',
     ];
     public $primaryKey = 'id_rating';
     public $incrementing = false;
}
