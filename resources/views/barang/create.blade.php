@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">Tambah Barang</h3>
    </div>
    
    <div class="card-body">
        <form method="POST" action="{{ url('/barang') }}" class="form-horizontal">
            @csrf

            <!-- Kode Barang -->
            <div class="form-group row">
                <label class="col-2 col-form-label">Kode Barang</label>
                <div class="col-10">
                    <input type="text" class="form-control" id="barang_kode" name="barang_kode" value="{{ old('barang_kode') }}" required>
                    @error('barang_kode')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <!-- Nama Barang -->
            <div class="form-group row">
                <label class="col-2 col-form-label">Nama Barang</label>
                <div class="col-10">
                    <input type="text" class="form-control" id="barang_nama" name="barang_nama" value="{{ old('barang_nama') }}" required>
                    @error('barang_nama')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <!-- Harga Beli -->
            <div class="form-group row">
                <label class="col-2 col-form-label">Harga Beli</label>
                <div class="col-10">
                    <input type="number" class="form-control" id="harga_beli" name="harga_beli" value="{{ old('harga_beli') }}" required>
                    @error('harga_beli')
                        <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
            </div>

            <!-- Harga Jual -->
            <div class="form-group row">
                <label class="col-2 col-form-label">Harga Jual</label>
                <div class="col-10">
                    <input type="number" class="form-control" id="harga_jual" name="harga_jual" value="{{ old('harga_jual') }}" required>
                    @error('harga_jual')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

          <!-- Kategori (Dropdown dari m_kategori) -->
<div class="form-group row">
    <label class="col-2 col-form-label">Kategori</label>
    <div class="col-10">
        <select class="form-control" id="kategori_id" name="kategori_id" required>
            <option value="">Pilih Kategori</option>
            <option value="1">Elektronik</option>
            <option value="2">Pakaian</option>
            <option value="3">Makanan</option>
            <option value="4">Minuman</option>
        </select>
        @error('kategori_id')
            <small class="form-text text-danger">{{ $message }}</small>
        @enderror
    </div>
</div>

            <!-- Buttons -->
            <div class="form-group row">
                <div class="col-10 offset-2">
                    <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                    <a class="btn btn-sm btn-default ml-1" href="{{ url('barang') }}">Kembali</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection