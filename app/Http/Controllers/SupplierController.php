<?php

namespace App\Http\Controllers;

use App\Models\SupplierModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SupplierController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Supplier',
            'list' => ['Home', 'Supplier']
        ];

        $page = (object) [
            'title' => 'Daftar Supplier'
        ];

        $activeMenu = 'supplier';
        $suppliers = SupplierModel::all();

        return view('supplier.index', compact('breadcrumb', 'page', 'suppliers', 'activeMenu'));
    }

    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Supplier',
            'list' => ['Home', 'Supplier', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah Supplier Baru'
        ];

        $activeMenu = 'supplier';

        return view('supplier.create', compact('breadcrumb', 'page', 'activeMenu'));
    }

    public function show(string $id)
    {
        $supplier = SupplierModel::find($id);

        $breadcrumb = (object) [
            'title' => 'Detail Supplier',
            'list' => ['Home', 'Supplier', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail Supplier'
        ];

        $activeMenu = 'supplier';

        return view('supplier.show', compact('breadcrumb', 'page', 'supplier', 'activeMenu'));
    }

    public function list(Request $request)
    {
        $suppliers = SupplierModel::select('supplier_id', 'nama_supplier', 'email', 'telepon', 'alamat');

        return DataTables::of($suppliers)
            ->addIndexColumn()
            ->addColumn('action', function ($supplier) {
                return '<a href="' . url('/supplier/' . $supplier->supplier_id) . '" class="btn btn-info btn-sm">Detail</a> '
                    . '<a href="' . url('/supplier/' . $supplier->supplier_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> '
                    . '<form class="d-inline-block" method="POST" action="' . url('/supplier/' . $supplier->supplier_id) . '">'
                    . csrf_field() . method_field('DELETE')
                    . '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin ingin menghapus supplier ini?\');">Delete</button>
                </form>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_supplier' => 'required|string|max:100',
            'email' => 'required|email|unique:m_supplier,email',
            'telepon' => 'required|string|max:20|unique:m_supplier,telepon',
            'alamat' => 'required|string|max:255'
        ]);

        SupplierModel::create($request->all());

        return redirect('/supplier')->with('success', 'Supplier berhasil ditambahkan!');
    }

    public function edit(string $id)
    {
        $supplier = SupplierModel::find($id);
        if (!$supplier) {
            return redirect('/supplier')->with('error', 'Supplier tidak ditemukan.');
        }

        $breadcrumb = (object) [
            'title' => 'Edit Supplier',
            'list' => ['Home', 'Supplier', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit Supplier'
        ];

        $activeMenu = 'supplier';

        return view('supplier.edit', compact('breadcrumb', 'page', 'supplier', 'activeMenu'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_supplier' => 'required|string|max:100',
            'email' => 'required|email|unique:m_supplier,email,' . $id . ',supplier_id',
            'telepon' => 'required|string|max:20|unique:m_supplier,telepon,' . $id . ',supplier_id',
            'alamat' => 'required|string|max:255'
        ]);

        $supplier = SupplierModel::find($id);
        if (!$supplier) {
            return redirect('/supplier')->with('error', 'Supplier tidak ditemukan.');
        }

        $supplier->update($request->all());

        return redirect('/supplier')->with('success', 'Supplier berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        $supplier = SupplierModel::find($id);
        if (!$supplier) {
            return redirect('/supplier')->with('error', 'Supplier tidak ditemukan.');
        }

        try {
            $supplier->delete();
            return redirect('/supplier')->with('success', 'Supplier berhasil dihapus!');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/supplier')->with('error', 'Supplier gagal dihapus karena masih terkait dengan data lain.');
        }
    }
}