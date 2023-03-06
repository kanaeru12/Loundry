<?php

namespace App\Http\Controllers;

use App\Models\member;
use Illuminate\Http\Request;
use Validator;


class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $member = Member::all();
        return view('member.index', compact('member'));
    }


    public function data(){
        $member = Member::orderBy('id', 'desc')->get();

        return datatables()
        ->of($member)
        ->addIndexColumn()
        ->addColumn('aksi', function($member){
            return'
            <div class="btn-group">
                <button onclick="editData(`'.route('member.update', $member->id).'`)" class="btn btn-flat btn-xs btn-warning"><i class="fa fa-edit"></i></button>
                <button onclick="deleteData(`'.route('member.destroy', $member->id).'`)" class="btn btn-flat btn-xs btn-danger"><i class="fa fa-trash"></i></button>
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
        return view('member.form');
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
            'jenis_kelamin' => 'required',
            'telepon' => 'required|numeric'
        ]);

       $member = Member::create([
        'nama' => $request->nama,
        'alamat' => $request->alamat,
        'jenis_kelamin' => $request->jenis_kelamin,
        'telepon' => $request->telepon
       ]);

       return response()->json([
        'success' => true,
        'massage' => 'Data berhasil disimpan',
        'data' => $member
       ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\member  $member
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $member = Member::find($id);
        return response()->json($member);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\member  $member
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $member = Member::find($id);
        return view('member.form', compact('member')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\member  $member
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $member = Member::find($id);
        $member->nama = $request->nama;
        $member->alamat = $request->alamat;
        $member->jenis_kelamin = $request->jenis_kelamin;
        $member->telepon = $request->telepon;
        $member->update();
        return response()->json('Data berhasil disimpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\member  $member
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $member = Member::find($id);
        $member->delete();
    }
}