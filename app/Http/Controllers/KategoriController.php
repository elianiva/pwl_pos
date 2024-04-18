<?php

namespace App\Http\Controllers;

use App\DataTables\KategoriDataTable;
use App\Models\KategoriModel;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index(KategoriDataTable $dataTable)
    {
        return $dataTable->render('kategori.index');
    }

    public function create()
    {
        return view('kategori.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validateWithBag('category', [
            'kategori_kode' => ['bail', 'required', 'unique:m_kategori', 'max:4'],
            'kategori_nama' => ['required'],
        ]);
        KategoriModel::create([
            'kategori_kode' => $validated['kategori_kode'],
            'kategori_nama' => $validated['kategori_nama'],
        ]);
        return redirect('/kategori');
    }

    public function update(int $id)
    {
        $data = KategoriModel::find($id);
        return view('kategori.update', ['kategori' => $data]);
    }

    public function edit(Request $request, int $id)
    {
        $data = KategoriModel::find($id);
        $data->kategori_kode = $request->kodeKategori;
        $data->kategori_nama = $request->namaKategori;
        $data->save();
        return redirect('/kategori');
    }

    public function delete(int $id)
    {
        $kategori = KategoriModel::find($id);
        $kategori->delete();
        return redirect('/kategori');
    }
}
