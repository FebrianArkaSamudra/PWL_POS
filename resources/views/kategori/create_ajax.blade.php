<form action="{{ url('/kategori/ajax') }}" method="POST" id="form-add">
    @csrf
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Kategori</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Kategori ID</label>
                    <input type="text" name="kategori_id" id="kategori_id" class="form-control" required>
                    <small id="error-kategori_id" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Kategori Level</label>
                    <input type="text" name="level_kategori" id="level_kategori" class="form-control" required>
                    <small id="error-level_kategori" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Kategori Name</label>
                    <input type="text" name="nama_kategori" id="nama_kategori" class="form-control" required>
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
    $("#form-add").validate({
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
                    if (response.status) {
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
        errorPlacement: function(error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function(element) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function(element) {
            $(element).removeClass('is-invalid');
        }
    });
});
</script>