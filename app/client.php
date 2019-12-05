<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class client extends Model
{
    protected $guarded = [
        'created_at','updated_at',
     ];
     
     public $primaryKey = 'id_client';
     public $incrementing = false;


     public function pengajars()
    {
      return $this->belongsToMany(pengajar::class,'clients_pengajars','id_client','id_pengajar')
              ->withPivot(['jml_temu','total_biaya'])
              ->withTimestamps();
    }
}
