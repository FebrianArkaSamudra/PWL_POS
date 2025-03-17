@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">Tambah Supplier</h3>
    </div>
    
    <div class="card-body">
        <form method="POST" action="{{ url('/supplier') }}" class="form-horizontal">
            @csrf

            <!-- Nama Supplier -->
            <div class="form-group row">
                <label class="col-2 col-form-label">Nama Supplier</label>
                <div class="col-10">
                    <input type="text" class="form-control" id="nama_supplier" name="nama_supplier" value="{{ old('nama_supplier') }}" required>
                    @error('nama_supplier')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <!-- Email -->
            <div class="form-group row">
                <label class="col-2 col-form-label">Email</label>
                <div class="col-10">
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                    @error('email')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <!-- Telepon -->
            <div class="form-group row">
                <label class="col-2 col-form-label">Telepon</label>
                <div class="col-10">
                    <input type="text" class="form-control" id="telepon" name="telepon" value="{{ old('telepon') }}" required>
                    @error('telepon')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <!-- Alamat -->
            <div class="form-group row">
                <label class="col-2 col-form-label">Alamat</label>
                <div class="col-10">
                    <textarea class="form-control" id="alamat" name="alamat" rows="3" required>{{ old('alamat') }}</textarea>
                    @error('alamat')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <!-- Buttons -->
            <div class="form-group row">
                <div class="col-10 offset-2">
                    <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                    <a class="btn btn-sm btn-default ml-1" href="{{ url('supplier') }}">Kembali</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection