@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">Edit Supplier</h3>
    </div>
    <div class="card-body">
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if($supplier)
            <form method="POST" action="{{ url('/supplier/' . $supplier->supplier_id) }}" class="form-horizontal">
                @csrf
                @method('PUT')

                <!-- Nama Supplier -->
                <div class="form-group row">
                    <label class="col-3 col-form-label">Nama Supplier</label>
                    <div class="col-9">
                        <input type="text" class="form-control" name="nama_supplier" value="{{ $supplier->nama_supplier }}" required>
                        @error('nama_supplier')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <!-- Email -->
                <div class="form-group row">
                    <label class="col-3 col-form-label">Email</label>
                    <div class="col-9">
                        <input type="email" class="form-control" name="email" value="{{ $supplier->email }}" required>
                        @error('email')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>

                <!-- Telepon -->
                <div class="form-group row">
                    <label class="col-3 col-form-label">Telepon</label>
                    <div class="col-9">
                        <input type="text" class="form-control" name="telepon" value="{{ $supplier->telepon }}" required>
                        @error('telepon')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>

                <!-- Alamat -->
                <div class="form-group row">
                    <label class="col-3 col-form-label">Alamat</label>
                    <div class="col-9">
                        <textarea class="form-control" name="alamat" rows="3" required>{{ $supplier->alamat }}</textarea>
                        @error('alamat')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>

                <!-- Tombol Submit -->
                <div class="form-group row">
                    <label class="col-3 col-form-label"></label>
                    <div class="col-9">
                        <button type="submit" class="btn btn-primary">Update Supplier</button>
                        <a href="{{ url('/supplier') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
            </form>
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