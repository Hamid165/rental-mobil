<?php

namespace App\Http\Controllers;

use App\Models\TanggalWaktu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaWaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tawa = TanggalWaktu::all();

        return response()->json([
            "message"=>"load data success",
            "data"=> $tawa
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
            "tanggal_ambil" =>'Masukan Tanggal Ambil',
            "tanggal_kembali" => "Masukan Tanggal Kembali",
            "waktu_ambil" => "Masukan Warna Mobil1",
            "waktu_kembali" => "Masukan Waktu Kembali",
            // "publisher" => "Masukan Judul",
            // "date_of_issue" => "Masukan Judul"
        ];
        $validasi = Validator::make($request->all(),[
            "tanggal_ambil" =>"required",
            "tanggal_kembali" => "required",
            "waktu_ambil" => "required",
            "waktu_kembali" => "required",
            // "publisher" => "required",
            // "date_of_issue" => "required"
        ], $message);
        if ($validasi ->fails()) {
            return $validasi -> errors();
        }
        $tawa = TanggalWaktu::create($validasi->validate());
        $tawa->save();

        return response()->json([
            "message"=>"load data success",
            "data"=> $tawa
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
        $tawa = TanggalWaktu::find($id);
        if($tawa){
            return $tawa;
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
        $tawa = TanggalWaktu::findOrFail($id);
        $tawa->update($request->all());
        $tawa->save();

        return $tawa;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tawa = TanggalWaktu::find($id);
        if($tawa){
            $tawa->delete();
            return ["message" => "Delete Berhasil"];
        }else{
            return ["message" => "Data tidak ditemukan"];
        }
    }
}
