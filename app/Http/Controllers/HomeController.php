<?php

namespace App\Http\Controllers;

use App\User;
use App\Paket;
use App\Member;
use App\Transaksi;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::count();
        $member = Member::count();
        $paket = Paket::count();
        $trx = Transaksi::count();

        $widget = [
            'users' => $users,
            'member' => $member,
            'paket' => $paket,
            'trx' => $trx
            //...
        ];
        $transaksiPaid = Transaksi::where('dibayar', 'dibayar')->get();

        return view('home', compact('widget'), [
            'transaksiPaid' => $transaksiPaid
        ]);
            
       

       

    }

    public function generateData() {

        
    }
}
