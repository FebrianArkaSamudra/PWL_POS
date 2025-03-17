@extends('layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools">
                <a class="btn btn-sm btn-primary mt-1" href="{{ url('barang/create') }}">Add Barang</a>
            </div>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <!-- Filter Barang -->
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Filter:</label>
                        <div class="col-3">
                            <select class="form-control" id="barang_id" name="barang_id">
                                <option value="">- Semua -</option>
                                @foreach($barang as $item)
                                    <option value="{{ $item->barang_id }}">{{ $item->barang_nama }}</option>
                                @endforeach
                            </select>
                            <small class="form-text text-muted">Pilih Kode</small>
                        </div>
                    </div>
                </div>
            </div>


            <table class="table table-bordered table-striped table-hover table-sm" id="table_barang">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Harga Beli</th>
                        <th>Harga Jual</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@push('css')
@endpush

@push('js')
<script>
$(document).ready(function() {
    var dataBarang = $('#table_barang').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ url('barang/list') }}",
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            data: function(d) {
                d.barang_name = $('#barang_name').val();
            },
            error: function(xhr, error, thrown) {
                console.log(xhr.responseText);
                alert("Error loading data. Check console for details.");
            }
        },
        columns: [
            { data: "DT_RowIndex", className: "text-center", orderable: false, searchable: false },
            { data: "barang_kode", orderable: true, searchable: true },
            { data: "barang_nama", orderable: true, searchable: true },
            { data: "harga_beli", orderable: true, searchable: true },
            { data: "harga_jual", orderable: true, searchable: true },
            { data: "action", orderable: false, searchable: false }
        ]
    });

    $('#barang_name').on('keyup', function(){
        dataBarang.ajax.reload();
    });
});
</script>
@endpush