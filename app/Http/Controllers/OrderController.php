<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mobil = Order::all();

        return response()->json([
            "message" => "Data Order Success",
            "data" => $mobil
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
            "mobil_id" => "Masukan mobil id",
            "user_id" => "Masukan user id",
            "nama_tempat" => "Masukan Nama Tempat",
            "kecamatan" => "Masukan Nama Kecamatan",
            "kabupaten" => "Masukan Nama Kabupaten",
            "tanggal_ambil" => "Masukan Tanggal Ambil",
            "tanggal_kembali" => "Masukan Tanggal Kembali",
            "waktu_ambil" => "Masukan Waktu Ambil",
            "waktu_kembali" => "Masukan Waktu Kembali",
            
            // "publisher" => "Masukan Judul",
            // "date_of_issue" => "Masukan Judul"
        ];
        $validasi = Validator::make($request->all(), [
            "mobil_id" => "required",
            "user_id" => "required",
            "nama_tempat" => "required",
            "kecamatan" => "required",
            "kabupaten" => "required",
            "tanggal_ambil" => "required",
            "tanggal_kembali" => "required",
            "waktu_ambil" => "required",
            "waktu_kembali" => "required",
            // "publisher" => "required",
            // "date_of_issue" => "required"
        ], $message);
        if ($validasi->fails()) {
            return $validasi->errors();
        }
        $mobil1 = Order::create($validasi->validate());
        $mobil1->save();

        return response()->json([
            "message" => "load data success",
            "data" => $mobil1
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
        $mobil2 = Order::find($id);
        if ($mobil2) {
            return $mobil2;
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
        $mobil2 = Order::findOrFail($id);
        $mobil2->update($request->all());
        $mobil2->save();

        return $mobil2;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delmobil = Order::find($id);
        if ($delmobil) {
            $delmobil->delete();
            return ["message" => "Delete Berhasil"];
        } else {
            return ["message" => "Data tidak ditemukan"];
        }
    }
}