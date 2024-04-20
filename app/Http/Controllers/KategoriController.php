<?php

namespace App\Http\Controllers;

use App\DataTables\KategoriDataTable;
use App\Http\Requests\StorePostRequest;
use App\Models\CategoryModel;
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

    public function store(StorePostRequest $request)
    {
        $validated = $request->validated();
        CategoryModel::create([
            'kategori_kode' => $validated['kategori_kode'],
            'kategori_nama' => $validated['kategori_nama'],
        ]);
        return redirect('/kategori');
    }

    public function update(int $id)
    {
        $data = CategoryModel::find($id);
        return view('kategori.update', ['kategori' => $data]);
    }

    public function edit(Request $request, int $id)
    {
        $data = CategoryModel::find($id);
        $data->kategori_kode = $request->kodeKategori;
        $data->kategori_nama = $request->namaKategori;
        $data->save();
        return redirect('/kategori');
    }

    public function delete(int $id)
    {
        $kategori = CategoryModel::find($id);
        $kategori->delete();
        return redirect('/kategori');
    }
}
