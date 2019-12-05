<?php
namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;
class ClientPengajar extends Pivot
{
    use SoftDeletes;
        protected $guarded = [
        'created_at','updated_at','deleted_at','id'
     ];
    protected $table = 'clients_pengajars';
}
