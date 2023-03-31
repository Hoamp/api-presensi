<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AbsensiController extends Controller
{
    public function show($id)
    {
        // kembalikan absensi sesuai id
        return Absensi::find($id);
    }

    public function store(Request $request)
    {
        // validasi inputan 
        $validated = Validator::make($request->all(), [
            'siswa_id' => 'required',
            'masuk' => 'required'
        ]);

        // jika ada data kosong
        if ($validated->fails()) {
            return response()->json($validated->errors());
        }

        // insert data absen
        $absen = Absensi::create([
            'tanggal' => Carbon::now(),
            'siswa_id' => $request->siswa_id,
            'masuk' => $request->masuk,
            'keterangan' => 'masuk'
        ]);

        // jika berhasil
        if ($absen) {
            // kembalikan response berhasil
            return response()->json([
                'success' => true,
                'message' => "Berhasil tambah absensi",
                'data' => $absen
            ], 201);
        } else {
            // jika gagal
            return response()->json([
                'success' => false,
                'message' => "Gagal absensi",
            ], 400);
        }
    }


    public function update(Request $request, $id)
    {
        // validasi inputan 
        $validated = Validator::make($request->all(), [
            'pulang' => 'required'
        ]);

        // jika ada data kosong
        if ($validated->fails()) {
            return response()->json($validated->errors());
        }

        // ubah ketika pulang
        $absen = Absensi::find($id)->update([
            'pulang' => Carbon::now()->toTimeString()
        ]);

        // jika berhasil
        if ($absen) {
            // kembalikan response berhasil
            return response()->json([
                'success' => true,
                'message' => "Berhasil absen pulang",
            ], 200);
        } else {
            // jika gagal
            return response()->json([
                'success' => false,
                'message' => "Gagal absensi",
            ], 400);
        }
    }
}
