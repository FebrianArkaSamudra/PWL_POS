@extends('layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
        </div>
        <div class="card-body">
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            @if($kategori)
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>ID</th>
                        <td>{{ $kategori->kategori_id }}</td>
                    </tr>
                    <tr>
                        <th>Level Kategori</th>
                        <td>{{ $kategori->kategori_kode }}</td>
                    </tr>
                    <tr>
                        <th>Nama Kategori</th>
                        <td>{{ $kategori->kategori_nama }}</td>
                    </tr>
                </table>

                <a href="{{ url('/kategori') }}" class="btn btn-secondary mt-3">Kembali</a>
            @else
                <div class="alert alert-danger">
                    <h5><i class="icon fas fa-ban"></i> Error!</h5>
                    Data kategori tidak ditemukan.
                </div>
                <a href="{{ url('/kategori') }}" class="btn btn-default mt-2">Kembali</a>
            @endif
        </div>
    </div>
@endsection