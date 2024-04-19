<?php

namespace App\Http\Controllers;

use App\Models\CategoryModel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CategoryController extends Controller
{
    public function index()
    {
        $breadcrumb = (object)[
            'title' => 'Daftar Category',
            'list' => ['Home', 'Category']
        ];
        $page = (object)[
            'title' => 'Daftar category yang terdaftar dalam sistem',
        ];
        $activeMenu = 'category';
        return view('category.index', [
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu,
            'page' => $page,
        ]);
    }

    public function list(Request $request)
    {
        $categorys = CategoryModel::select('kategori_id', 'kategori_kode', 'kategori_nama')->get();

        return DataTables::of($categorys)->addIndexColumn()->addColumn('action', function ($category) {
            $btn = '<a href="/category/' . $category->category_id . '" class="btn btn-primary btn-sm">Detail</a>';
            $btn = $btn . ' <a href="/category/' . $category->category_id . '/edit" class="btn btn-warning btn-sm">Edit</a>';
            $btn .= '<form class="d-inline-block" method="POST" action="' .
                url('/category/' . $category->category_id) . '">' . csrf_field() . method_field('DELETE') .
                '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure to delete this data?\');" >Delete</button></form>';
            return $btn;
        })
            ->rawColumns(['action'])
            ->make();
    }

    public function create()
    {
        $breadcrumb = (object)[
            'title' => 'Tambah Category',
            'list' => ['Home', 'Category', 'Tambah']
        ];
        $page = (object)[
            'title' => 'Tambah category baru',
        ];
        $activeMenu = 'category';

        return view('category.create', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu, 'page' => $page]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori_kode' => 'required|string|min:3|unique:m_kategori,kategori_kode',
            'kategori_nama' => 'required|string|max:100',
        ]);

        CategoryModel::create([
            'kategori_kode' => $request->kategori_kode,
            'kategori_nama' => $request->kategori_nama,
        ]);

        return redirect('/category')->with('success', 'Category created successfully.');
    }

    public function show(string $id)
    {
        $breadcrumb = (object)[
            'title' => 'Detail Category',
            'list' => ['Home', 'Category', 'Detail']
        ];
        $page = (object)[
            'title' => 'Detail category',
        ];
        $activeMenu = 'category';
        return view('category.show', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu, 'page' => $page]);
    }

    public function edit(string $id)
    {
        $category = CategoryModel::find($id);

        $breadcrumb = (object)[
            'title' => 'Edit Category',
            'list' => ['Home', 'Category', 'Edit']
        ];
        $page = (object)[
            'title' => 'Edit category',
        ];
        $activeMenu = 'category';
        return view('category.edit', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu, 'page' => $page, 'category' => $category]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'kategori__kode' => 'required|string|min:3|unique:m_kategori_,kategori__kode',
            'kategori__nama' => 'required|string|max:100',
        ]);

        CategoryModel::find($id)->update([
            'kategori_name' => $request->kategori_name,
            'kategori_code' => $request->kategori_code,
        ]);

        return redirect('/category')->with('success', 'Category updated successfully.');
    }

    public function destroy(string $id)
    {
        $check = CategoryModel::find($id);
        if (!$check) {
            return redirect('/category')->with('error', 'Category not found.');
        }

        try {
            CategoryModel::find($id)->delete();
            return redirect('/category')->with('success', 'Category deleted successfully.');
        } catch (\Exception $e) {
            return redirect('/category')->with('error', 'Category not found.');
        }
    }


}
