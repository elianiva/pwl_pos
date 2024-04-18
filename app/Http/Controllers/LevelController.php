<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLevelRequest;
use App\Models\LevelModel;
use Illuminate\Support\Facades\DB;

class LevelController extends Controller
{
    public function index()
    {
        $data = DB::select('select * from m_level');
        return view('level', ['data' => $data]);
    }

    public function insert(StoreLevelRequest $request)
    {
        $validated = $request->validated();
        LevelModel::create([
            'level_kode' => $validated['level_kode'],
            'level_nama' => $validated['level_nama'],
        ]);
        return 'Insert data baru berhasil';
    }

    public function update()
    {
         $row = DB::update('update m_level set level_nama = ? where level_kode = ?', ['Customer', 'CUS']);
         return "Update data berhasil. Jumlah data yang diupdate: $row";
    }

    public function delete()
    {
         $row = DB::delete('delete from m_level where level_kode = ?', ['CUS']);
         return "Delete data berhasil. Jumlah data yang dihapus: $row";
    }
}
