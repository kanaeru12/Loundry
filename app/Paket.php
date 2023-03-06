<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
    protected $table = 'tb_paket';

    protected $fillable = [
        'id_outlet', 'jenis', 'nama_paket', 'harga'
    ];

     public function outlet(){
        return $this-> hasOne(Outlet::class , 'id', 'id_outlet');
    }
}
