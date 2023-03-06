<?php

namespace App\Http\Controllers;

use App\User;
use App\Paket;
use App\Member;
use App\Outlet;
use App\Transaksi;
use App\TransaksiDetail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $outlet = Outlet::all();
        $member = Member::all();
        $transaksi = Transaksi::all();

        return view('transaksi.list', [
            'title' => 'Data Transaksi',
            'transaksi' => $transaksi,
            'member' => $member,
            'outlet' => $outlet

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $outlet = Outlet::all();
        $member = Member::all();
        $transaksi = Transaksi::with(['outlet', 'member'])->get();

        return view('transaksi.create', [
            'title' => 'New Transaksi',
            'member' => $member,
            'outlet' => $outlet,
            'transaksi' => $transaksi
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $invoice = 'LAUND-'. Str::random(6);
        $user = Auth::user()->id;

        Transaksi::create([
            'id_outlet' => $request->id_outlet,
            'kode_invoice' => $invoice,
            'id_member' => $request->id_member,
            'tgl' => $request->tgl,
            'batas_waktu' => $request->batas_waktu,
            'tgl_bayar' => $request->tgl_bayar,
            'biaya_tambahan' => $request->biaya_tambahan,
            'diskon' => $request->diskon,
            'pajak' => $request->pajak,
            'status' => "baru",
            'dibayar' => "belum dibayar",
            'id_user' => $user,
        ]);

        return redirect('/dashboard/transaksi/bayar/'.$invoice)->with('message', 'User added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($kode)
    {
        // $transaksi = Transaksi::where('kode_invoice', $kode)->first();
        // $paket = Paket::where('id_outlet', $transaksi->id_outlet)->get();

        // return view('transaksi.pilih-paket', [
        //     'transaksi' => $transaksi,
        //     'paket' => $paket

        // ]);
    }

    public function show_detail($kode_invoice)
    {
        $transaksi = Transaksi::where('kode_invoice', $kode_invoice)->first();
        $paket = Paket::where('id_outlet', $transaksi->id_outlet)->get();
        $transaksiDetail = TransaksiDetail::where('id_transaksi', $transaksi->id)->get();
        
        return view ('transaksi.pilih-paket', [
            'title' => 'New Transaksi',
            'transaksi' => $transaksi,
            'paket' => $paket,
            'details' => $transaksiDetail

        ]);
    }

  

    public function selectpaket(Request $req)
    {
        $paket = paket::where('id',$req->id)->first();
        $output = '<div class="card mb-3">
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <div class="harga-paket mb-2" style="font-size: 28px;">'.$paket->nama_paket.'</div>
                </div>
                <div class="col-md-4 col-12">
                    <div class="total-price text-center" style="padding: 7px; 
                                background-color: rgb(18, 155, 18);    
                                color:#fff; 
                                border-radius: 20px; 
                                margin-bottom: 20px;">
                         Rp.'.number_format($paket->harga,0,',','.') .'
                    </div>
                </div>
                <div class="col-12">
                    <label for="keterangan"
                        class="form-label">Deskripsi</label>
                    <textarea class="form-control" id="keterangan" name = "keterangan"
                        rows="3"></textarea>
                </div>
                

                <div class="col-12">
                <label for="qty"
                        class="form-label mt-2">Jumlah Barang</label>
                <input type="number" name="qty" id="qty" class="form-control mb-3" min="1" required>
                </div>
                
                <div class="col-md-4 col-12">
                    <button onclick="return addpaket('.$req->id_transaksi.','.$paket->id.')" type="submit" class="btn btn-success w-100 mt-2"
                   style="background-color: rgb(18, 155, 18);">Tambah</button>

               </div>
            </div>
        </div>
        
    </div>';

        return response($output);
    }

      public function tambahpaket(Request $req, $id_transaksi, $id_paket)
    {
        $validate = $req->validate([
            'qty' => ['required'],
            'keterangan' => ['max:255']
        ]);

        $validate['id_transaksi'] = $id_transaksi;
        $validate['id_paket'] = $id_paket;

        $newTransaksi = TransaksiDetail::create($validate);
        return response($newTransaksi);

        
    }

    public  function hapuspaket($id)
    {
        $id = TransaksiDetail::find($id);
        $id->delete();

        return redirect()->back();

    }

    public function tambahbiaya(Request $req, $id)
    {
        $transaksi = Transaksi::find($id);
        $details = TransaksiDetail::where('id_transaksi', $id)->get();
        $validate = $req->validate([
            'batas_waktu' => ['required'],
            'biaya_tambahan' => ['max:255'],
            'pajak' => ['max:255'],
            'diskon' => ['max:255']
        ]);

        $subtotal=0;
        foreach($details as $dtl)
        {
            $harga = $dtl->paket->harga*$dtl->qty;
            $subtotal += ($harga);
        }

        $total = $req->pajak + $req->biaya_tambahan + $subtotal;
        $discount = $total * $req->diskon / 100;
        $fixtotal = $total - $discount ;

        $validate['total_harga'] = $fixtotal;
        Transaksi::where('id', $id)->update($validate);

        return redirect('/dashboard/transaksi-list');

    }
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaksi $transaksi,  )
    {
        
        return view('transaksi.edit', [
            'transaksi' => $transaksi,
            'title' => 'Edit Data Transaksi',
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, $id)
    {
        $data['dibayar'] = $req->dibayar;
        $data['status'] = $req->status;
        $data['tgl_bayar'] = $req->tgl_bayar;

        Transaksi::where('id',$id)->update($data);
        return redirect()->route('transaksi.index')->with('message', 'Data Transaksi updated successfully!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id = Transaksi::find($id);
        $id->delete();


        return redirect()->back()->with('message', 'Transaksiphp  deleted successfully!');
    }
}
