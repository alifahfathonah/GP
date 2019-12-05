<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class keahlian extends Model
{
    protected $guarded = [
        'created_at','updated_at','id_keahlian'
     ];
     public $primaryKey = 'id_keahlian';
     public $incrementing = false;

     
}
