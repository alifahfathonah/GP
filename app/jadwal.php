<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class jadwal extends Model
{
    protected $fillable = [
        'id_pengajar','hari',
     ];
     protected $table = 'jadwals';
     public $primaryKey = 'id_jadwal';
     public $incrementing = false;

     public function pengajar()
     {
       return $this->hasOne(pengajar::class,'id_pengajar');
     }
}
