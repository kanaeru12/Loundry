<?php

namespace App\Http\Controllers;

use App\Member;
use App\Outlet;
use Illuminate\Http\Request;

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

        return view('member.list', [
            'title' => 'Data Membership',
            'member' => $member
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('member.create', [
            'title' => 'New Membership',
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
        // Member::create([
        //     'nama' => $request->nama,
        //     'alamat' => $request->alamat,
        //     'jenis_kelamin' => $request->jenis_kelamin,
        //     'tlp' => $request->tlp,
        // ]);

        $this->validate($request , [
            'nama' => 'required',
            'alamat' => 'required',
            'jenis_kelamin' => 'required',
            'tlp' => 'required'

        ]);

        Member::create($request->all());

        return redirect()->route('member.index')->with('message', 'Outlet added successfully!');
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
    public function edit(Member $member)
    {
        return view('member.edit', [
            'title' => 'Edit Membership',
            'member' => $member
        ]);
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
        $data = $request->all();

        $member = Member::find($id);
        $member->update($data);

        return redirect()->route('member.index')->with('message', 'outlet updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id = Member::find($id);
        $id->delete();


        return redirect()->route('member.index')->with('message', 'Outlet deleted successfully!');
    }
}
