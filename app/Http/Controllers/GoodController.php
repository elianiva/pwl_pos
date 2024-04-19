<?php

namespace App\Http\Controllers;

use App\Models\GoodsModel;
use App\Models\CategoryModel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class GoodController extends Controller
{
    public function index()
    {
        $breadcrumb = (object)[
            'title' => 'Daftar Barang',
            'list' => ['Home', 'Barang']
        ];
        $page = (object)[
            'title' => 'Daftar barang yang terdaftar dalam sistem',
        ];
        $activeMenu = 'item';
        $categories = CategoryModel::all();
        return view('item.index', [
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu,
            'page' => $page,
            'categories' => $categories
        ]);
    }

    public function list(Request $request)
    {
        $items = GoodsModel::select('barang_id', 'barang_nama', 'barang_kode', 'harga_jual', 'harga_beli', 'kategori_id')->with('kategori')->get();

        // filter by level_id
        if ($request->kategori_id) {
            $items = $items->where('kategori_id', $request->kategori_id);
        }

        return DataTables::of($items)->addIndexColumn()->addColumn('action', function ($barang) {
            $btn = '<a href="/item/' . $barang->barang_id . '" class="btn btn-primary btn-sm">Detail</a>';
            $btn = $btn . ' <a href="/item/' . $barang->barang_id . '/edit" class="btn btn-warning btn-sm">Edit</a>';
            $btn .= '<form class="d-inline-block" method="POST" action="' .
                url('/item/' . $barang->barang_id) . '>' . csrf_field() . method_field('DELETE') .
                '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure to delete this data?\');">Delete</button></form>';
            return $btn;
        })
            ->rawColumns(['action'])
            ->make();
    }

    public function create()
    {
        $breadcrumb = (object)[
            'title' => 'Tambah Barang',
            'list' => ['Home', 'Barang', 'Tambah']
        ];
        $page = (object)[
            'title' => 'Tambah barang baru',
        ];
        $activeMenu = 'item';
        $categories = CategoryModel::all();

        return view('item.create', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu, 'page' => $page, 'categories' => $categories]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'barang_kode' => 'required|string|min:3|unique:m_barang,barang_kode',
            'barang_name' => 'required|string|min:3|unique:m_barang,barang_name',
            'harga_beli' => 'required|integer',
            'harga_jual' => 'required|integer',
            'kategori_id' => 'required|integer',
        ]);

        GoodsModel::create([
            'barang_kode' => $request->barang_kode,
            'barang_name' => $request->barang_name,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual,
            'kategori_id' => $request->kategori_id,
        ]);

        return redirect('/item')->with('success', 'Barang created successfully.');
    }

    public function show(string $id)
    {
        $barang = GoodsModel::with('kategori')->find($id);
        $breadcrumb = (object)[
            'title' => 'Detail Barang',
            'list' => ['Home', 'Barang', 'Detail']
        ];
        $page = (object)[
            'title' => 'Detail barang',
        ];
        $activeMenu = 'item';
        return view('item.show', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu, 'page' => $page, 'barang' => $barang]);
    }

    public function edit(string $id)
    {
        $barang = GoodsModel::find($id);
        $categories = CategoryModel::all();

        $breadcrumb = (object)[
            'title' => 'Edit Barang',
            'list' => ['Home', 'Barang', 'Edit']
        ];
        $page = (object)[
            'title' => 'Edit barang',
        ];
        $activeMenu = 'item';
        return view('item.edit', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu, 'page' => $page, 'barang' => $barang, 'categories' => $categories]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'barang_kode' => 'required|string|min:3|unique:m_barang,barang_kode',
            'barang_name' => 'required|string|min:3|unique:m_barang,barang_name',
            'harga_beli' => 'required|integer',
            'harga_jual' => 'required|integer',
            'kategori_id' => 'required|integer',
        ]);

        GoodsModel::find($id)->update([
            'barang_kode' => $request->barang_kode,
            'barang_name' => $request->barang_name,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual,
            'kategori_id' => $request->kategori_id,
        ]);

        return redirect('/item')->with('success', 'Barang updated successfully.');
    }

    public function destroy(string $id)
    {
        $check = GoodsModel::find($id);
        if (!$check) {
            return redirect('/item')->with('error', 'Barang not found.');
        }

        try {
            GoodsModel::find($id)->delete();
            return redirect('/item')->with('success', 'Barang deleted successfully.');
        } catch (\Exception $e) {
            return redirect('/item')->with('error', 'Barang not found.');
        }
    }


}
