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

        @if($level)
            <form method="POST" action="{{ url('/level/' . $level->level_id) }}" class="form-horizontal">
                @csrf
                @method('PUT') 

                <!-- Pilihan Nama Level -->
                <div class="form-group row">
                    <label class="col-3 col-form-label">Nama Level</label>
                    <div class="col-9">
                        <select class="form-control" name="level_nama" required>
                            <option value="">- Pilih Nama Level -</option>
                            @foreach($levelOptions as $option)
                                <option value="{{ $option->level_nama }}" 
                                    @if($option->level_nama == $level->level_nama) selected @endif>
                                    {{ $option->level_nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('level_nama')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <!-- Tombol Submit -->
                <div class="form-group row">
                    <label class="col-3 col-form-label"></label>
                    <div class="col-9">
                        <button type="submit" class="btn btn-primary">Update Level</button>
                        <a href="{{ url('/level') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
            </form>
        @else
            <div class="alert alert-danger">
                <h5><i class="icon fas fa-ban"></i> Error!</h5>
                Data level tidak ditemukan.
            </div>
            <a href="{{ url('/level') }}" class="btn btn-default mt-2">Kembali</a>
        @endif
    </div>
</div>
@endsection