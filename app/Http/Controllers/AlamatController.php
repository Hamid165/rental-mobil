<?php

namespace App\Http\Controllers;

use App\Models\Alamat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AlamatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alamat = Alamat::all();

        return response()->json([
            "message" => "load data success",
            "data" => $alamat
        ], 200);
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
        $message = [
            "desa" => "Masukan Nama Desa",
            "kecamatan_user" => "Masukan Nama Kecamatan",
            "kabupaten_user" => "Masukan Nama Kabupaten"
        ];
        $validasi = Validator::make($request->all(), [
            "desa" => "required",
            "kecamatan_user" => "required",
            "kabupaten_user" => "required"
        ], $message);
        if ($validasi->fails()) {
            return $validasi->errors();
        }
        $alamat = Alamat::create($validasi->validate());
        $alamat->save();

        return response()->json([
            "message" => "load data success",
            "data" => $alamat
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $alamat = Alamat::find($id);
        if ($alamat) {
            return $alamat;
        } else {
            return ["message" => "Data tidak ditemukan"];
        }
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
        $alamat = Alamat::findOrFail($id);
        $alamat->update($request->all());
        $alamat->save();

        return $alamat;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delalamat = Alamat::find($id);
        if ($delalamat) {
            $delalamat->delete();
            return ["message" => "Delete Berhasil"];
        } else {
            return ["message" => "Delete tidak ada"];
        }
    }
}
