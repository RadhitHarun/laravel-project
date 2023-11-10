{{-- Ajax for Handling Foreman Validation View --}}
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function () {
        // Ajax Table Validasi
        var table = $('#table-validasi').DataTable({
            pagingType: "simple",
            processing: true,
            serverSide: true,
            ajax: "{{ route('foreman.ListValidasiJob') }}",
            columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex' },
            { data: 'project', name: 'project' },
            { data: 'id_job', name: 'id_job' },
            { data: 'part_name',  name: 'part_name' },
            { data: 'validasi',  name: 'validasi' },
            { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });

        var tableValidated = $('#table-validated').DataTable({
            pagingType: "simple",
            processing: true,
            serverSide: true,
            ajax: "{{ route('foreman.jobValidated') }}",
            columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex' },
            { data: 'project', name: 'project' },
            { data: 'id_job', name: 'id_job' },
            { data: 'id_mch', name: 'id_mch' , defaultContent: '-'},
            { data: 'lead_time',  name: 'lead_time' },
            { data: 'part_name',  name: 'part_name' },
            { data: 'validasi',  name: 'validasi' },
            ]
        });

        // Button for showing ValidationModal
        $('body').on('click', '.validasiProject', function () {
            var project_id = $(this).data('id');
            $.get("{{ route('foreman.showValidasiJob', ':id') }}".replace(':id', project_id), function (data) {
                $('#validasiForm').trigger("reset");
                $('#validasiModal').modal('show');
                $('#project_id').val(data.id);
                $('#id_job').val(data.id_job);
                $('#part_name').val(data.part_name);
            });
        });

        // Button Validasi
        $('#btnValidasi').click(function (e) {
            e.preventDefault();
            var checkboxes = $('input[name="options[]"]:checked');

            if (checkboxes.length === 0) {
                $('#validationErrorMessage').removeClass('d-none'); // Tampilkan pesan error
                $('#validationSuccessMessage').addClass('d-none'); // Sembunyikan pesan sukses
            } else {
                $('#validationErrorMessage').addClass('d-none'); // Sembunyikan pesan error jika ada yang dicentang
                var validasiData = $('#validasiForm').serialize();
                var project_id = $('#project_id').val();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: validasiData,
                    url: "{{ route('foreman.validasiJob', ':id') }}".replace(':id', project_id),
                    type: "PUT",
                    dataType: 'json',
                    success: function (validasiData) {
                        $('#validasiForm').trigger("reset");
                        $('#validasiModal').modal('hide');
                        table.draw();
                        tableValidated.draw();
                        $('#validationSuccessMessage').removeClass('d-none'); // Tampilkan pesan sukses

                        // Menghilangkan pesan sukses setelah 3 detik
                        setTimeout(function () {
                            $('#validationSuccessMessage').addClass('d-none');
                        }, 3000);
                    },
                    error: function (errorData) {
                        console.log('Error:', errorData);
                    }
                });
            }
        });

        // btn for closing modal
        $('#closeBtnValidasi').click(function (e) {
            e.preventDefault(); // Mencegah perilaku default (refresh halaman)
            $('#validasiModal').modal('hide');
        });

    });
</script>

