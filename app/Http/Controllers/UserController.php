<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Validator;
use Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::all();

        // dd($user);
        return view('user.index', compact('user'));
    }

    public function data(){
        $user = User::orderBy('id', 'desc')->get();

        return datatables()
        ->of($user)
        ->addIndexColumn()
        ->editColumn('role_id', function($user){
            return $user->role->nama;
        })
        ->addColumn('aksi', function($user){
            return'
            <div class="btn-group">
                <button onclick="editData(`'.route('user.update', $user->id).'`)" class="btn btn-flat btn-xs btn-warning"><i class="fa fa-edit"></i></button>
                <button onclick="deleteData(`'.route('user.destroy', $user->id).'`)" class="btn btn-flat btn-xs btn-danger"><i class="fa fa-trash"></i></button>
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
        return view('user.form');
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
            'name' => 'required|alpha',
            'email' => 'required',
            'password' => 'required',
            'role_id' => 'required'
        ]);

       $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'remember_token' => Str::random(20),
        'role_id' => $request->role_id
       ]);

       return response()->json([
        'success' => true,
        'massage' => 'Data berhasil disimpan',
        'data' => $user
       ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return response()->json($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('user.form', compact('user')); 
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
        $user = User::find($id);

        $user->update($request->all());
        if ($request->hasFile('avatar')) {
            $request->file('avatar')->move('public/profile', $request->file('avatar')->getClientOriginalName());
            $user->avatar = $request->file('avatar')->getClientOriginalName();
            $user->save();
        }
        // dd($user);

        return redirect(route('user.profile', Auth()->user()->id))->with('sukses', 'Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
    }

    public function profile($id)
    {
        return view('user.profile');
    }
}