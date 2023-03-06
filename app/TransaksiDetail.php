<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\CssSelector\Node\FunctionNode;

class TransaksiDetail extends Model
{
    protected $table = 'tb_transaksi_details';

    protected $guarded = ['id'];
    protected $with = ['paket', 'transaksi'];

    public function transaksi() {
        return $this->hasOne(Transaksi::class,'id', 'id_transaksi');
    }

    public function paket() {
        return $this->belongsTo(Paket::class, 'id_paket');
    }
}
