@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">Edit Barang</h3>
    </div>
    <div class="card-body">
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if($barang)
            <form method="POST" action="{{ url('/barang/' . $barang->barang_id) }}" class="form-horizontal">
                @csrf
                @method('PUT')

                <!-- Kode Barang -->
                <div class="form-group row">
                    <label class="col-3 col-form-label">Kode Barang</label>
                    <div class="col-9">
                        <input type="text" class="form-control" name="kode_barang" value="{{ $barang->kode_barang }}" required>
                        @error('kode_barang')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <!-- Nama Barang -->
                <div class="form-group row">
                    <label class="col-3 col-form-label">Nama Barang</label>
                    <div class="col-9">
                        <input type="text" class="form-control" name="nama_barang" value="{{ $barang->nama_barang }}" required>
                        @error('nama_barang')
                            <small class="text-danger">{{ $message}}</small>
                        @enderror
                    </div>
                </div>

                <!-- Harga Beli -->
                <div class="form-group row">
                    <label class="col-3 col-form-label">Harga Beli</label>
                    <div class="col-9">
                        <input type="number" class="form-control" name="harga_beli" value="{{ $barang->harga_beli }}" required>
                        @error('harga_beli')
                            <small class="text-danger">{{ $message}}</small>
                        @enderror
                    </div>
                </div>

                <!-- Harga Jual -->
                <div class="form-group row">
                    <label class="col-3 col-form-label">Harga Jual</label>
                    <div class="col-9">
                        <input type="number" class="form-control" name="harga_jual" value="{{ $barang->harga_jual }}" required>
                        @error('harga_jual')
                            <small class="text-danger">{{ $message}}</small>
                        @enderror
                    </div>
                </div>

                <!-- Tombol Submit -->
                <div class="form-group row">
                    <label class="col-3 col-form-label"></label>
                    <div class="col-9">
                        <button type="submit" class="btn btn-primary">Update Barang</button>
                        <a href="{{ url('/barang') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
            </form>
        @else
            <div class="alert alert-danger">
                <h5><i class="icon fas fa-ban"></i> Error!</h5>
                Data barang tidak ditemukan.
            </div>
            <a href="{{ url('/barang') }}" class="btn btn-default mt-2">Kembali</a>
        @endif
    </div>
</div>
@endsection