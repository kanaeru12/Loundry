<?php

namespace App\Http\Controllers;

use App\Models\outlet;
use Illuminate\Http\Request;
use Validator;

class OutletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $outlet = Outlet::all();
        return view('outlet.index', compact('outlet'));
    }

    public function data(){
        $outlet = Outlet::orderBy('id', 'desc')->get();

        return datatables()
        ->of($outlet)
        ->addIndexColumn()
        ->addColumn('aksi', function($outlet){
            return'
            <div class="btn-group">
                <button onclick="editData(`'.route('outlet.update', $outlet->id).'`)" class="btn btn-flat btn-xs btn-warning"><i class="fa fa-edit"></i></button>
                <button onclick="deleteData(`'.route('outlet.destroy', $outlet->id).'`)" class="btn btn-flat btn-xs btn-danger"><i class="fa fa-trash"></i></button>
            </div>
            ';
        })
        ->rawColumns(['aksi'])
        ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('outlet.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'nama' => 'required|alpha',
            'alamat' => 'required',
            'telepon' => 'required|numeric'
        ]);

       $outlet = Outlet::create([
        'nama' => $request->nama,
        'alamat' => $request->alamat,
        'telepon' => $request->telepon
       ]);

       return response()->json([
        'success' => true,
        'massage' => 'Data berhasil disimpan',
        'data' => $outlet
       ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\outlet  $outlet
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $outlet = Outlet::find($id);
        return response()->json($outlet);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\outlet  $outlet
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $outlet = Outlet::find($id);
        return view('outlet.form', compact('outlet'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\outlet  $outlet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $outlet = Outlet::find($id);
        $outlet->nama = $request->nama;
        $outlet->alamat = $request->alamat;
        $outlet->telepon = $request->telepon;
        $outlet->update();
        return response()->json('Data berhasil disimpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\outlet  $outlet
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $outlet = Outlet::find($id);
        $outlet->delete();
    }
}
