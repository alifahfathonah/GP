<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pengajar extends Model
{
    protected $guarded = [
        'created_at','updated_at','id_pengajar'
     ];
     public $primaryKey = 'id_pengajar';
     public $incrementing = false;

     public function jadwal()
     {
       return $this->hasOne(jadwal::class,'id_pengajar');
     }

     public function keahlian()
     {
      return $this->hasOne(keahlian::class,'id_keahlian');
     }
}
