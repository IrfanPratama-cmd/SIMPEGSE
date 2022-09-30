<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jabatan;

class JabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('jabatan.index', [
            'jabatan' => Jabatan::all()
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

    public function tambahJabatan(Request $request)
    {
        $validatedData = $request->validate([
            'nama_jabatan' => 'required|max:255',
            'gaji_pokok' => 'required',
            'tunjangan_jabatan' => 'required',
            'tunjangan_makan_perhari' => 'required',
            'tunjangan_transport_perhari' => 'required',
        ]);

        Jabatan::create($validatedData);

        return redirect('/jabatan')->with('success', 'Jabatan Berhasil di Tambah');
    }

    public function editJabatan($id, Request $request)
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_jabatan' => 'required|max:255',
            'gaji_pokok' => 'required',
            'tunjangan_jabatan' => 'required',
            'tunjangan_makan_perhari' => 'required',
            'tunjangan_transport_perhari' => 'required',
        ]);

        $jabatan   =   Jabatan::updateOrCreate(
            ['id' => $request->id],
            [
                'nama_jabatan' => $request->nama_jabatan,
                'gaji_pokok' => $request->gaji_pokok,
                'tunjangan_jabatan' => $request->tunjangan_jabatan,
                'tunjangan_makan_perhari' => $request->tunjangan_makan_perhari,
                'tunjangan_transport_perhari' => $request->tunjangan_transport_perhari,
            ]
        );

        return response()->json(['code' => 200, 'message' => 'Jabatan Created successfully', 'data' => $jabatan], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $jabatan = Jabatan::find($id);

        return response()->json($jabatan);
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
        $jabatan = Jabatan::find($id)->delete();

        return response()->json(['success' => 'Jabatan Deleted successfully']);
    }
}
