<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pertemuan extends Model
{
    protected $guarded = [
        'created_at','id_pertemuan'
     ];
     public $primaryKey = 'id_pertemuan';
     public $incrementing = false;
}
