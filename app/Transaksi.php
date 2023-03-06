<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'tb_transaksi';

    protected $guarded = ['id'];

    public function outlet(){
        return $this-> hasOne(Outlet::class , 'id', 'id_outlet');
    }

    public function transaksi_detail() {
        return $this-> belongsTo(TransaksiDetail::class);
    }

    public function member(){
        return $this->hasOne(Member::class, 'id', 'id_member');
    }

    public function paket() {
        return $this->belongsToMany(Paket::class, 'id_paket');
    }

    public function user() {
        return $this->belongsTo(User::class, 'id_user');
    }

    



    
}
