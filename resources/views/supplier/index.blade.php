@extends('layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools">
                <a class="btn btn-sm btn-primary mt-1" href="{{ url('supplier/create') }}">Add Supplier</a>
            </div>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Filter:</label>
                        <div class="col-3">
                            <input type="text" class="form-control" id="supplier_name" placeholder="Cari Nama Supplier">
                            <small class="form-text text-muted">Nama Supplier</small>
                        </div>
                    </div>
                </div>
            </div>  

            <table class="table table-bordered table-striped table-hover table-sm" id="table_supplier">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Supplier</th>
                        <th>Email</th>
                        <th>Telepon</th>
                        <th>Alamat</th>
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
    var dataSupplier = $('#table_supplier').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ url('supplier/list') }}",
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            data: function(d) {
                d.supplier_name = $('#supplier_name').val();
            },
            error: function(xhr, error, thrown) {
                console.log(xhr.responseText);
                alert("Error loading data. Check console for details.");
            }
        },
        columns: [
            { data: "DT_RowIndex", className: "text-center", orderable: false, searchable: false },
            { data: "nama_supplier", orderable: true, searchable: true },
            { data: "email", orderable: true, searchable: true },
            { data: "telepon", orderable: true, searchable: true },
            { data: "alamat", orderable: true, searchable: true },
            { data: "action", orderable: false, searchable: false }
        ]
    });

    $('#supplier_name').on('keyup', function(){
        dataSupplier.ajax.reload();
    });
});
</script>
@endpush