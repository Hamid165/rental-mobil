<?php

namespace App\Http\Controllers;

use App\Models\tempat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TempatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tempat = tempat::all();

        return response()->json([
            "message" => "load data success",
            "data" => $tempat
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
            "nama_tempat" => "Masukan Nama Tempatmu Sekarang",
            "kecamatan" => "Masukan Nama Kecamatan",
            "kabupaten" => "Masukan Nama Kabupaten",
            // "publisher" => "Masukan Judul",
            // "date_of_issue" => "Masukan Judul"
        ];
        $validasi = Validator::make($request->all(), [
            "nama_tempat" => "required",
            "kecamatan" => "required",
            "kabupaten" => "required",
            // "publisher" => "required",
            // "date_of_issue" => "required"
        ], $message);
        if ($validasi->fails()) {
            return $validasi->errors();
        }
        $tempat1 = tempat::create($validasi->validate());
        $tempat1->save();

        return response()->json([
            "message" => "load data success",
            "data" => $tempat1
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
        $tempat2 = tempat::find($id);
        if ($tempat2) {
            return $tempat2;
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
        $tempat3 = tempat::findOrFail($id);
        $tempat3->update($request->all());
        $tempat3->save();

        return $tempat3;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deltempat = tempat::find($id);
        if ($deltempat) {
            $deltempat->delete();
            return ["message" => "Delete Berhasil"];
        } else {
            return ["message" => "Data tidak ditemukan"];
        }
    }
}
