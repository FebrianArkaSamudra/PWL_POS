<?php

namespace App\Http\Controllers;

use App\Models\BarangModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BarangController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Barang',
            'list' => ['Home', 'Barang']
        ];

        $page = (object) [
            'title' => 'Daftar Barang'
        ];

        $activeMenu = 'barang';
        $barang = BarangModel::all();

        return view('barang.index', compact('breadcrumb', 'page', 'barang', 'activeMenu'));
    }

    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Barang',
            'list' => ['Home', 'Barang', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah Barang Baru'
        ];

        $activeMenu = 'barang';

        return view('barang.create', compact('breadcrumb', 'page', 'activeMenu'));
    }

    public function show(string $id)
    {
        $barang = BarangModel::find($id);

        $breadcrumb = (object) [
            'title' => 'Detail Barang',
            'list' => ['Home', 'Barang', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail Barang'
        ];

        $activeMenu = 'barang';

        return view('barang.show', compact('breadcrumb', 'page', 'barang', 'activeMenu'));
    }

    public function list(Request $request)
    {
        $barang = BarangModel::select('barang_id', 'barang_kode', 'barang_nama', 'harga_beli', 'harga_jual');

        return DataTables::of($barang)
            ->addIndexColumn()
            ->addColumn('action', function ($barang) {
                return '<a href="' . url('/barang/' . $barang->barang_id) . '" class="btn btn-info btn-sm">Detail</a> '
                    . '<a href="' . url('/barang/' . $barang->barang_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> '
                    . '<form class="d-inline-block" method="POST" action="' . url('/barang/' . $barang->barang_id) . '">' 
                    . csrf_field() . method_field('DELETE')
                    . '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin ingin menghapus barang ini?\');">Delete</button>
                </form>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $request->validate([
            'barang_kode' => 'required|string|max:50|unique:m_barang,barang_kode',
            'barang_nama' => 'required|string|max:100',
            'harga_beli' => 'required|numeric|min:0',
            'harga_jual' => 'required|numeric|min:0'
        ]);

        BarangModel::create($request->all());

        return redirect('/barang')->with('success', 'Barang berhasil ditambahkan!');
    }

    public function edit(string $id)
    {
        $barang = BarangModel::find($id);
        if (!$barang) {
            return redirect('/barang')->with('error', 'Barang tidak ditemukan.');
        }

        $breadcrumb = (object) [
            'title' => 'Edit Barang',
            'list' => ['Home', 'Barang', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit Barang'
        ];

        $activeMenu = 'barang';

        return view('barang.edit', compact('breadcrumb', 'page', 'barang','activeMenu'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'barang_kode' => 'required|string|max:50|unique:m_barang,barang_kode,' . $id . ',barang_id',
            'barang_nama' => 'required|string|max:100',
            'harga_beli' => 'required|numeric|min:0',
            'harga_jual' => 'required|numeric|min:0'
        ]);

        $barang = BarangModel::find($id);
        if (!$barang) {
            return redirect('/barang')->with('error', 'Barang tidak ditemukan.');
        }

        $barang->update($request->all());

        return redirect('/barang')->with('success', 'Barang berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        $barang = BarangModel::find($id);
        if (!$barang) {
            return redirect('/barang')->with('error', 'Barang tidak ditemukan.');
        }

        try {
            $barang->delete();
            return redirect('/barang')->with('success', 'Barang berhasil dihapus!');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/barang')->with('error', 'Barang gagal dihapus karena masih terkait dengan data lain.');
        }
    }
}