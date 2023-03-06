<?php

namespace App\Http\Controllers;

use App\User;
use App\Transaksi;
use App\TransaksiDetail;
use Illuminate\Http\Request;

class NotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($kode)
    {
        $transaksi = Transaksi::where('kode_invoice',$kode)->first();
        $details = TransaksiDetail::where('id_transaksi', $transaksi->id)->get();
        $user = User::all();
        $subtotal=0;
        foreach($details as $dtl)
        {
            $harga = $dtl->paket->harga*$dtl->qty;
            $subtotal += ($harga);
        }
        return view('laporan.nota',[
            'transaksi' => $transaksi,
            'detail' => TransaksiDetail::where('id_transaksi',$transaksi->id)->get(),
            'subtotal' => $subtotal,
            'user' => $user
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
