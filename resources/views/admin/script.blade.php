<script>
$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function btnSimpan(){
        $('.tombol-simpan').show();
        $('.tombol-update').hide();
    }

    function btnUpdate() {
        $('.tombol-update').show();
        $('.tombol-simpan').hide();
    }

$(document).ready(function () {
    var table = $('#table-index').DataTable({
        pagingType : "simple",
        processing: true,
        serverSide: true,
        ajax: "{{ route('project.index') }}",
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex' },
            { data: 'project', name: 'project' },
            { data: 'Anumber', name: 'Anumber' },
            { data: 'part_name', name: 'part_name' },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ]
    });

    // Tambah Project
    $('#addProject').click(function () {
        btnSimpan();
        $('#projectForm').trigger("reset");
        $('.modal-title').text("Add Project");
        $('#exampleModal').modal('show');
    });

    // Simpan Project
    $('.tombol-simpan').click(function () {
        var formData = $('#projectForm').serialize();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: formData,
            url: "{{ route('project.store') }}",
            type: "POST",
            dataType: 'json',
            success: function (data) {
                $('#projectForm').trigger("reset");
                $('#exampleModal').modal('hide');
                table.draw();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });

    $('.tombol-update').click(function () {
        var updateData = $('#projectForm').serialize();
        var project_id = $('#project_id').val();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: updateData,
            url: "{{ route('project.update', ':id') }}".replace(':id', project_id),
            type: "PUT",
            dataType: 'json',
            success: function (updatedData) {
                $('#projectForm').trigger("reset");
                $('#exampleModal').modal('hide');
                table.draw();
            },
            error: function (errorData) {
                console.log('Error:', errorData);
            }
        });
    });

    // Edit Project
    $('body').on('click', '.editProject', function () {
        var project_id = $(this).data('id');
        $.get("{{ route('project.index') }}" + '/' + project_id + '/edit', function (data) {
            $('#projectForm').trigger("reset");
            $('.modal-title').text("Edit Project");
            $('#exampleModal').modal('show');
            $('#project_id').val(data.id);
            $('#project').val(data.project);
            $('#Anumber').val(data.Anumber);
            $('#part_name').val(data.part_name);
            btnUpdate(); // Menampilkan tombol "Update" saat mengedit
        });
    });

    // Hapus Project
    $('body').on('click', '.deleteProject', function () {
        var project_id = $(this).data("id");
        if (confirm("Apakah Anda yakin ingin menghapus project ini?")) {
            $.ajax({
                type: "DELETE",
                url: "{{ route('project.index') }}" + '/' + project_id,
                data: {
                    "_token": "{{ csrf_token() }}"
                },
                success: function (data) {
                    table.draw();
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        }
    });

});
</script>

<script>
    function checkAndFixAnumber() {
        var input = document.getElementById('Anumber');
        var value = input.value;
        
        // Pastikan nilai dimulai dengan "A", jika tidak, tambahkan "A" di awal
        if (value.length === 0 || value.charAt(0) !== 'A') {
            input.value = 'A' + value;
        }
    }

    document.getElementById('Anumber').addEventListener('blur', function() {
    var idJobInput = this.value;
    if (idJobInput.length !== 7 || !idJobInput.startsWith('A')) {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Anumber harus memiliki panjang 7 karakter!',
            });
        }
    });
</script>
