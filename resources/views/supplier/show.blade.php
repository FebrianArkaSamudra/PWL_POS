@extends('layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">Detail Supplier</h3>
        </div>
        <div class="card-body">
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            @if($supplier)
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>ID Supplier</th>
                        <td>{{ $supplier->supplier_id }}</td>
                    </tr>
                    <tr>
                        <th>Nama Supplier</th>
                        <td>{{ $supplier->nama_supplier }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $supplier->email }}</td>
                    </tr>
                    <tr>
                        <th>Telepon</th>
                        <td>{{ $supplier->telepon }}</td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td>{{ $supplier->alamat }}</td>
                    </tr>
                </table>

                <a href="{{ url('/supplier') }}" class="btn btn-secondary mt-3">Kembali</a>
            @else
                <div class="alert alert-danger">
                    <h5><i class="icon fas fa-ban"></i> Error!</h5>
                    Data supplier tidak ditemukan.
                </div>
                <a href="{{ url('/supplier') }}" class="btn btn-default mt-2">Kembali</a>
            @endif
        </div>
    </div>
@endsection