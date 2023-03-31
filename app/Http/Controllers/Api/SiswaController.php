<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SiswaResource;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SiswaController extends Controller
{
    public function index()
    {
        // ambil seluruh data siswa
        $siswa = Siswa::with(['absensi'])->latest()->get();

        // kembalikan collection $siswa ke resource
        return new SiswaResource(true, "Semua data siswa", $siswa);
    }

    public function store(Request $request)
    {
        // validasi semua inputan user
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'nis' => 'required',
            'alamat' => 'required',
            'jenis_kelamin' => 'required',
        ]);

        // jika data ada yang gagal divalidasai
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // masukkan ke dalam database
        $siswa = Siswa::create([
            'nama' => $request->nama,
            'nis' => $request->nis,
            'alamat' => $request->alamat,
            'jenis_kelamin' => $request->jenis_kelamin
        ]);

        // kembalikan resource
        return new SiswaResource(true, "Berhasil input data siswa", $siswa);
    }

    public function show(Siswa $siswa)
    {
        // kembalikan resource dengan 1 hasil data siswa
        return new SiswaResource(true, "Data siswa ditemukan", $siswa);
    }

    public function update(Request $request, Siswa $siswa)
    {
        // validasi inputan user
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'nis' => 'required',
            'alamat' => 'required',
            'jenis_kelamin' => 'required',
        ]);

        // jika data ada yang gagal divalidasai
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // update data siswa lama ke data baru
        $siswa->update([
            'nama' => $request->nama,
            'nis' => $request->nis,
            'alamat' => $request->alamat,
            'jenis_kelamin' => $request->jenis_kelamin
        ]);

        // kembalikan resource
        return new SiswaResource(true, "Data siswa berhasil diubah", $siswa);
    }

    public function destroy(Siswa $siswa)
    {
        // hapus data siswa
        $siswa->delete();

        // kembalikan json
        return new SiswaResource(true, "Data siswa berhasil dihapus", null);
    }
}
