@empty ($category)
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
            <a href="{{ url('/category') }}" class="btn btn-warning">Return</a>
        </div>
    </div>
</div>
@else
<form action="{{ url('/category/' . $category->category_id . '/update_ajax') }}" method="POST" id="form-edit">
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
                    <label>ID</label>
                    <select name="category_id" id="category_id" class="form-control" required>
                        <option value="">-- Select Kategori ID --</option>
                        @foreach ($kategoriList as $item)
                            <option value="{{ $item->kategori_id }}" {{ $item->kategori_id == $category->kategori_id ? 'selected' : '' }}>
                                {{ $item->kategori_id }}
                            </option>
                        @endforeach
                    </select>
                    <small id="error-category_id" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Kode Kategori</label>
                    <select name="category_code" id="category_code" class="form-control" required>
                        <option value="">-- Select Level --</option>
                        @foreach ($kategoriList as $item)
                            <option value="{{ $item->kategori_kode }}" {{ $item->kategori_kode == $category->kategori_kode ? 'selected' : '' }}>
                                {{ $item->kategori_kode }}
                            </option>
                        @endforeach
                    </select>
                    <small id="error-category_code" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Nama Kategori</label>
                    <select name="category_name" id="category_name" class="form-control" required>
                        <option value="">-- Select Kategori Name --</option>
                        @foreach ($kategoriList as $item)
                            <option value="{{ $item->kategori_nama }}" {{ $item->kategori_nama == $category->kategori_nama ? 'selected' : '' }}>
                                {{ $item->kategori_nama }}
                            </option>
                        @endforeach
                    </select>
                    <small id="error-category_name" class="error-text form-text text-danger"></small>
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
            category_id: { required: true, digits: true, minlength: 1, maxlength: 10 },
            category_code: { required: true, minlength: 2, maxlength: 20 },
            category_name: { required: true, minlength: 3, maxlength: 50 }
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