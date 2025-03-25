<?php

namespace App\Http\Controllers;

use App\Models\KategoriModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
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
        $categories = KategoriModel::select('kategori_id', 'level_kategori', 'nama_kategori');

        return DataTables::of($categories)
            ->addIndexColumn()
            ->addColumn('action', function ($category) {
                $btn = '<button onclick="modalAction(\''.url('/kategori/' . $category->kategori_id . '/show_ajax').'\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\''.url('/kategori/' . $category->kategori_id . '/edit_ajax').'\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\''.url('/kategori/' . $category->kategori_id . '/delete_ajax').'\')" class="btn btn-danger btn-sm">Delete</button> ';
                return $btn;
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

    public function create_ajax()
    {
        $kategoris = KategoriModel::all(); 
        return view('kategori.create_ajax', compact('kategoris'));
    }

    public function store_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'kategori_kode' => 'required|string|max:10|unique:kategoris,kategori_kode',
                'kategori_nama' => 'required|string|max:50'
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validation Failed',
                    'msgField' => $validator->errors()
                ]);
            }

            KategoriModel::create($request->all());

            return response()->json([
                'status' => true,
                'message' => 'Kategori successfully saved!'
            ]);
        }

        return redirect('/');
    }

    public function edit_ajax(string $id)
    {
        $kategori = KategoriModel::find($id);
        $kategoriList = KategoriModel::all();
    
        if (!$kategori) {
            return response()->json([
                'status' => false,
                'message' => 'Data not found'
            ], 404);
        }
    
        return view('kategori.edit_ajax', compact('kategori', 'kategoriList'));
    }

    public function update_ajax(Request $request, $id)
{
    Log::info("Received update request: ", $request->all());

    // Validate the request data
    $validator = Validator::make($request->all(), [
        'level_kategori' => 'required|string', 
        'nama_kategori' => 'required|string',  
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => false,
            'message' => 'Validation error',
            'errors' => $validator->errors()
        ], 422); 
    }

    $kategori = KategoriModel::find($id);
    if (!$kategori) {
        return response()->json([
            'status' => false,
            'message' => 'Category not found'
        ], 404);
    }

    try {
        $kategori->update([
            'level_kategori' => $request->input('level_kategori'),
            'nama_kategori' => $request->input('nama_kategori'),
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Category updated successfully',
            'data' => $kategori 
        ], 200); 
    } catch (\Exception $e) {
        Log::error("Error updating category: " . $e->getMessage());

        return response()->json([
            'status' => false,
            'message' => 'Failed to update category',
            'error' => $e->getMessage()
        ], 500); 
    }
}
    public function confirm_ajax(string $id)
    {
        $kategori = KategoriModel::find($id);
        return view('kategori.confirm_ajax', ['kategori' => $kategori]);
    }

    public function delete_ajax(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $kategori = KategoriModel::find($id);
            if ($kategori) {
                $kategori->delete();
                return response()->json([
                    'status' => true,
                    'message' => 'Kategori successfully deleted!'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Kategori not found'
                ]);
            }
        }
        return redirect('/');
    }
}