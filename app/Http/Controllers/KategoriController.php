<?php

namespace App\Http\Controllers;

use App\Models\KategoriModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class KategoriController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Kategori',
            'list' => ['Home', 'Kategori']
        ];

        $page = (object) [
            'title' => 'Daftar Kategori'
        ];

        $activeMenu = 'kategori';
        $kategoris = KategoriModel::all();

        return view('kategori.index', compact('breadcrumb', 'page', 'kategoris', 'activeMenu'));
    }

    public function create()
{
    $kategori = KategoriModel::all(); // Ambil semua kategori dari database
    return view('barang.create', compact('kategori'));
}

    public function show(string $id)
    {
        $kategori = KategoriModel::find($id);

        $breadcrumb = (object) [
            'title' => 'Detail Kategori',
            'list' => ['Home', 'Kategori', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail Kategori'
        ];

        $activeMenu = 'kategori';

        return view('kategori.show', compact('breadcrumb', 'page', 'kategori', 'activeMenu'));
    }

    public function list(Request $request)
    {
        $kategoris = KategoriModel::select('kategori_id', 'kategori_kode', 'kategori_nama');

return DataTables::of($kategoris)
    ->addIndexColumn()
    ->addColumn('action', function ($kategori) {
        return '<a href="' . url('/kategori/' . $kategori->kategori_id) . '" class="btn btn-info btn-sm">Detail</a> '
            . '<a href="' . url('/kategori/' . $kategori->kategori_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> '
            . '<form class="d-inline-block" method="POST" action="' . url('/kategori/' . $kategori->kategori_id) . '">'
            . csrf_field() . method_field('DELETE')
            . '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin ingin menghapus kategori ini?\');">Delete</button>
        </form>';
    })
    ->rawColumns(['action'])
    ->make(true);
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori_kode' => 'required|string|max:10|unique:m_kategori,kategori_kode',
            'kategori_nama' => 'required|string|max:100'
        ]);
        
        KategoriModel::create($request->all());

        return redirect('/kategori')->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function edit(string $id)
    {
        $kategori = KategoriModel::find($id);
        if (!$kategori) {
            return redirect('/kategori')->with('error', 'Kategori tidak ditemukan.');
        }
    
        $breadcrumb = (object) [
            'title' => 'Edit Kategori',
            'list' => ['Home', 'Kategori', 'Edit']
        ];
    
        $page = (object) [
            'title' => 'Edit Kategori'
        ];
    
        $activeMenu = 'kategori';
    
        // Mengambil daftar kategori yang bisa dipilih
        $kategoriOptions = KategoriModel::select('nama_kategori')->distinct()->get();
    
        return view('kategori.edit', compact('breadcrumb', 'page', 'kategori', 'kategoriOptions', 'activeMenu'));
    }
    

    public function update(Request $request, string $id)
    {
        $request->validate([
            'kategori_kode' => 'required|string|max:10|unique:m_kategori,kategori_kode,' . $id . ',kategori_id',
            'kategori_nama' => 'required|string|max:100'
        ]);
        
        $kategori = KategoriModel::find($id);
        $kategori->update($request->all());
    }

    public function destroy(string $id)
    {
        $kategori = KategoriModel::find($id);
        if (!$kategori) {
            return redirect('/kategori')->with('error', 'Kategori tidak ditemukan.');
        }

        try {
            $kategori->delete();
            return redirect('/kategori')->with('success', 'Kategori berhasil dihapus!');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/kategori')->with('error', 'Kategori gagal dihapus karena masih terkait dengan data lain.');
        }
    }
}