<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outlet extends Model
{
    protected $table = 'tb_outlets';

    protected $fillable = [
        'nama', 'alamat', 'no_telp'
    ];
}
