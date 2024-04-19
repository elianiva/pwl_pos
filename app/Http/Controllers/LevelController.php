<?php

namespace App\Http\Controllers;

use App\Models\LevelModel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class LevelController extends Controller
{
    public function index()
    {
        $breadcrumb = (object)[
            'title' => 'Daftar Level',
            'list' => ['Home', 'Level']
        ];
        $page = (object)[
            'title' => 'Daftar level yang terdaftar dalam sistem',
        ];
        $activeMenu = 'level';
        return view('level.index', [
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu,
            'page' => $page,
        ]);
    }

    public function list(Request $request)
    {
        $levels = LevelModel::select('level_id', 'level_kode', 'level_nama')->get();

        return DataTables::of($levels)->addIndexColumn()->addColumn('action', function ($level) {
            $btn = '<a href="/level/' . $level->level_id . '" class="btn btn-primary btn-sm">Detail</a>';
            $btn = $btn . ' <a href="/level/' . $level->level_id . '/edit" class="btn btn-warning btn-sm">Edit</a>';
            $btn .= '<form class="d-inline-block" method="POST" action="' .
                url('/level/' . $level->level_id) . '>' . csrf_field() . method_field('DELETE') .
                '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure to delete this data?\');" >Delete</button></form>';
            return $btn;
        })
            ->rawColumns(['action'])
            ->make();
    }

    public function create()
    {
        $breadcrumb = (object)[
            'title' => 'Tambah Level',
            'list' => ['Home', 'Level', 'Tambah']
        ];
        $page = (object)[
            'title' => 'Tambah level baru',
        ];
        $activeMenu = 'level';

        return view('level.create', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu, 'page' => $page]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'level_kode' => 'required|string|min:3|unique:m_level,level_kode',
            'level_nama' => 'required|string|max:100',
        ]);

        LevelModel::create([
            'level_kode' => $request->level_kode,
            'level_nama' => $request->level_nama,
        ]);

        return redirect('/level')->with('success', 'Level created successfully.');
    }

    public function show(string $id)
    {
        $breadcrumb = (object)[
            'title' => 'Detail Level',
            'list' => ['Home', 'Level', 'Detail']
        ];
        $page = (object)[
            'title' => 'Detail level',
        ];
        $activeMenu = 'level';
        return view('level.show', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu, 'page' => $page]);
    }

    public function edit(string $id)
    {
        $level = LevelModel::find($id);

        $breadcrumb = (object)[
            'title' => 'Edit Level',
            'list' => ['Home', 'Level', 'Edit']
        ];
        $page = (object)[
            'title' => 'Edit level',
        ];
        $activeMenu = 'level';
        return view('level.edit', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu, 'page' => $page, 'level' => $level]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'level_kode' => 'required|string|min:3|unique:m_level,level_kode',
            'level_nama' => 'required|string|max:100',
        ]);

        LevelModel::find($id)->update([
            'levelname' => $request->levelname,
            'email' => $request->email,
            'password' => $request->password ? bcrypt($request->password) : LevelModel::find($id)->password,
            'level_id' => $request->level_id,
        ]);

        return redirect('/level')->with('success', 'Level updated successfully.');
    }

    public function destroy(string $id)
    {
        $check = LevelModel::find($id);
        if (!$check) {
            return redirect('/level')->with('error', 'Level not found.');
        }

        try {
            LevelModel::find($id)->delete();
            return redirect('/level')->with('success', 'Level deleted successfully.');
        } catch (\Exception $e) {
            return redirect('/level')->with('error', 'Level not found.');
        }
    }


}
