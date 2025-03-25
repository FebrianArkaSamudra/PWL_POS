@empty ($kategori)
<div id="modal-master" class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Error</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="alert alert-danger">
                <h5><i class="fa fa-ban"></i> Error!!</h5>
                The data you are looking for is not found
            </div>
            <a href="{{ url('/kategori') }}" class="btn btn-warning">Return</a>
        </div>
    </div>
</div>
@else
<form action="{{ url('/kategori/' . $kategori->kategori_id . '/update_ajax') }}" method="POST" id="form-edit">
    @csrf
    @method('PUT')
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Kategori</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Kategori ID</label>
                    <select name="kategori_id" id="kategori_id" class="form-control" required>
                        <option value="">-- Select Kategori ID --</option>
                        @foreach ($kategoriList as $item)
                            <option value="{{ $item->kategori_id }}" {{ $item->kategori_id == $kategori->kategori_id ? 'selected' : '' }}>
                                {{ $item->kategori_id }}
                            </option>
                        @endforeach
                    </select>
                    <small id="error-kategori_id" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Kategori Level</label>
                    <select name="level_kategori" id="level_kategori" class="form-control" required>
                        <option value="">-- Select Level --</option>
                        @foreach ($kategoriList as $item)
                            <option value="{{ $item->level_kategori }}" {{ $item->level_kategori == $kategori->level_kategori ? 'selected' : '' }}>
                                {{ $item->level_kategori }}
                            </option>
                        @endforeach
                    </select>
                    <small id="error-level_kategori" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Kategori Name</label>
                    <select name="kategori_nama" id="nama_kategori" class="form-control" required>
                        <option value="">-- Select Kategori Name --</option>
                        @foreach ($kategoriList as $item)
                            <option value="{{ $item->nama_kategori }}" {{ $item->nama_kategori == $kategori->nama_kategori ? 'selected' : '' }}>
                                {{ $item->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                    <small id="error-nama_kategori" class="error-text form-text text-danger"></small>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-warning">Cancel</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</form>

<script>
$(document).ready(function() {
    $("#form-edit").validate({
        rules: {
            kategori_id: { required: true, digits: true, minlength: 1, maxlength: 10 },
            level_kategori: { required: true, minlength: 2, maxlength: 20 },
            nama_kategori: { required: true, minlength: 3, maxlength: 50 }
        },
        submitHandler: function(form) {
            $.ajax({
                url: form.action,
                type: form.method,
                data: $(form).serialize(),
                success: function(response) {
                    if(response.status) {
                        $('#myModal').modal('hide');
                        Swal.fire({
                            icon: 'success',
                            title: 'Succeed',
                            text: response.message
                        });
                        dataKategori.ajax.reload();
                    } else {
                        $('.error-text').text('');
                        $.each(response.msgField, function(prefix, val) {
                            $('#error-' + prefix).text(val[0]);
                        });
                        Swal.fire({
                            icon: 'error',
                            title: 'Something Went Wrong',
                            text: response.message
                        });
                    }
                }
            });
            return false;
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element) {
            $(element).removeClass('is-invalid');
        }
    });
});
</script>
@endempty