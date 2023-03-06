<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class outlet extends Model
{
    use HasFactory;

    protected $table = 'outlet';
    protected $guarded = [];

    public function transaksi(){
        return $this->belongsTo(Transaksi::class);
    }
   
}
