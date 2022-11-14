<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\mobil;
use Illuminate\Support\Facades\Validator;

class MobilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mobil = mobil::all();

        return response()->json([
            "message"=>"load data success",
            "data"=> $mobil
        ],200);
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
            "nama_mobil" => "Masukan Nama Mobil",
            "warna" => "Masukan Warna Mobil",
            "harga_rental" => "Masukan Harga Rental",
            // "publisher" => "Masukan Judul",
            // "date_of_issue" => "Masukan Judul"
        ];
        $validasi = Validator::make($request->all(),[
            "nama_mobil" => "required",
            "warna" => "required",
            "harga_mobil" => "required",
            // "publisher" => "required",
            // "date_of_issue" => "required"
        ], $message);
        if ($validasi ->fails()) {
            return $validasi -> errors();
        }
        $mobil1 = mobil::create($validasi->validate());
        $mobil1->save();

        return response()->json([
            "message"=>"load data success",
            "data"=> $mobil1
        ],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $mobil2 = mobil::find($id);
        if($mobil2){
            return $mobil2;
        }else{
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
        $mobil2 = mobil::findOrFail($id);
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
        $delmobil = mobil::find($id);
        if($delmobil){
            $delmobil->delete();
            return ["message" => "Delete Berhasil"];
        }else{
            return ["message" => "Delete tidak ditemukan"];
        }
    }
}

