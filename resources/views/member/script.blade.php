{{-- downtime/idle --}}
<script>
    $(document).ready(function () {
        // Fungsi untuk menangani event klik pada tombol di modal
        function handleModalButtonClick(idActivity, keterangan) {
            // Setel isi modal notifikasi sesuai dengan keterangan yang dipilih
            $('#keteranganNotifikasi').text('Saat ini sedang ' + keterangan);

            var user = {!! json_encode(Auth::user()) !!}; // Ambil informasi user yang sedang login

            // Kirim form menggunakan AJAX
            $.ajax({
                url: "{{ route('downtime.submit') }}",
                type: "POST",
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    id_activity: idActivity,
                    activity_name: keterangan,
                    user_id_mch: user.id_mch, // Menggunakan data dari user yang sedang login
                    user_name: user.name // Menggunakan data dari user yang sedang login
                },
                success: function (response) {
                    console.log(response); // Anda bisa melakukan sesuatu setelah sukses submit

                    // Tampilkan modal notifikasi
                    $('#notifModal').modal('show');
                    
                    // Tangani penutupan modal notifikasi saat tombol "Selesai" ditekan
                    $('#btnSelesai').on('click', function () {
                        $('#notifModal').modal('hide'); // Menutup modal notifikasi
                    });
                },
                error: function (xhr, status, error) {
                    console.log(xhr.responseText); // Log pesan error jika ada
                }
            });
        }

        // Tangani event klik pada tombol-tombol di dalam modal downtime
        $('#downtimeModal button').on('click', function () {
            var idActivity = $(this).data('id-activity');
            var keterangan = $(this).data('keterangan');
            handleModalButtonClick(idActivity, keterangan);
        });

        // Tangani event klik pada tombol-tombol di dalam modal idle
        $('#idleModal button').on('click', function () {
            var idActivity = $(this).data('id-activity');
            var keterangan = $(this).data('keterangan');
            handleModalButtonClick(idActivity, keterangan);
        });

        $('#btnSelesai').on('click', function() {
            updateStopAndProdHour();
        });

        function updateStopAndProdHour() {
            $.ajax({
                url: "{{ route('downtime.submitStop', ['id' => $ljkh->id]) }}",
                type: "POST",
                dataType: "json",
                data: {_token: $('meta[name="csrf-token"]').attr('content')},
                success: function(response) {
                    console.log(response);
                    $('#notifModal').modal('hide'); // Menutup modal setelah pembaruan
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }

        $('#btnTutupDI').on('click', function(e){
            e.preventDefault();
            $('#notifModal').modal('hide');
        });
    });
</script>

{{-- Ajax For Handling Member View --}}
<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var isStopwatchRunning = false;
        var startTime = 0;
        var stopwatchInterval;
        var isBlinking;
        var blinkInterval;
        var autoRunBlinkInterval;

        // For Handling Job Start 
        $('body').on('click', '.jobStart', function(e){
            e.preventDefault();
            var job_id = $(this).data('id');
            $.get("{{ route('member.showJob', ':id') }}".replace(':id', job_id), function(data) {
                $('#anForm').trigger("reset");
                $('#startJobModal').modal('show');
                $('#job_id').val(data.id);
                $('#project').val(data.id_mch);
            });
        });

        $("#anForm button").click(function(e) {
            e.preventDefault();
            var activity_name = $(this). data('activity_name');
            var user = {!! json_encode(Auth::user()) !!};

            $.ajax({
                type: "POST",
                url: "{{ route('member.start', ['id=> $ljkh->id']) }}",
                data: { 
                    _token: "{{ csrf_token() }}", 
                    activity_name : activity_name,
                    user_id_mch: user.id_mch,
                    user_name: user.name
                }, 
                success: function(response) {
                    // Handle the success response here
                    $('#startJobModal').modal('hide');

                    $('#notifModalStart').modal('show');
                    
                    $('#btnTutupStart').on('click', function () {
                        $('#notifModalStart').modal('hide');
                        setTimeout(function () {
                            updateIndexView();
                            startStopwatch();
                            startBlink();
                        }, 1000); // Menjalankan updateIndexView setelah 1 detik
                        setTimeout(function () {
                            $('#btnJobStart strong').text('JOB RUNNING');
                        }, 2000);
                    });
                },
                error: function(error) {
                    // Handle any errors here
                    console.error("Error starting job:", error);
                }
            });
        });

        // For Handling Job End
        $('body').on('click', '.jobEnd', function(e){
            e.preventDefault();
            var job_id = $(this).data('id');
            $.get("{{ route('member.showJob', ':id') }}".replace(':id', job_id), function(data) {
                $('#endJobForm').trigger("reset");
                $('#endJobModal').modal('show');
                $('#job_id').val(data.id);
                $('#id_job').val(data.id_job);
            });
        });
    
        // Function to handle the "JOB END" button click
        $('#btnEndJob').on('click', function(e) {
            e.preventDefault();

            var jobId = $(this).data('id');

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('member.stop', ':id') }}".replace(':id', jobId),
                type: 'POST',
                dataType: 'json',
                success: function(response) {
                    $('#endJobModal').modal('hide');
                    
                    $('#notifModalEnd').modal('show');
                },
                error: function(error) {
                    console.error("Error:", error);
                }
            });
        });

        $(document).on('click', '#btnTutupEnd', function(e){
            e.preventDefault();
            stopStopwatch();
            $('#notifModalEnd').modal('hide');
            setTimeout(function() {
                updateIndexView();
                stopBlink();
                $('#btnJobStart strong').text('JOB START');
            }, 500);
        });

        $('#btnTutupEndJob').click(function(e) {
            e.preventDefault();
            $('#endJobModal').modal('hide');
        });

        $('#nextShift').on('click', function(e) {
            e.preventDefault();
            $('#endJobModal').modal('hide');
            $('#nextShiftModal').modal('show');
        });

        $('#btnNextShift').on('click', function(e) {
            e.preventDefault();

            var jobId = $(this).data('id');
            var noteValue = $('#inputInfoShift').val();

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('member.nextShift', ':id') }}".replace(':id', jobId),
                type: "POST",
                dataType: 'json',
                data: {note:noteValue},
                success: function (response) {

                },
                error: function (error) {
                    console.error("Error:", error);
                }
            });
        });

        $(document).on('click', '#btnNextShift',function(e){
            e.preventDefault();
            stopStopwatch();
            $('#nextShiftModal').modal('hide');
            $('#notifModalEnd').modal('show');
        });

        // For Handling cancel Job
        $('.jobCancel').on('click', function(e) {
            e.preventDefault();
            var jobId = $(this).data('id');

            // Tampilkan SweetAlert konfirmasi
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Anda tidak akan bisa mengembalikan tindakan ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, batalkan pekerjaan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika pengguna mengkonfirmasi, kirim permintaan AJAX untuk membatalkan pekerjaan
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "{{ route('member.cancel', ':id') }}".replace(':id', jobId),
                        type: 'POST',
                        dataType: 'json',
                        success: function(response) {
                            if (response.success) {
                                Swal.fire('Berhasil!', 'Pekerjaan telah dicancel.', 'success').then(function() {
                                    setTimeout(function() {
                                        // Di sini Anda dapat memperbarui tampilan atau melakukan tindakan lain yang diperlukan.
                                        updateIndexView();
                                    }, 1000);
                                });
                            } else {
                                Swal.fire('Gagal!', 'Gagal cancel pekerjaan.', 'error');
                            }
                        },
                        error: function(error) {
                            console.error("Error:", error);
                        }
                    });
                }
            });
        });

        // For Handling Take Job
        $(document).ready(function() {
            // Ajax table JobList
            var table = $('#table-jobList').DataTable({
                pagingType: "simple_numbers",
                pageLength: 10,
                processing: true,
                responsive: true,
                serverSide: true,
                ajax: "{{ route('member.indexJob') }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    { data: 'project', name: 'project' },
                    { data: 'id_job', name: 'id_job' },
                    { data: 'die_part', name: 'die_part'},
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ],
                // dom: '<"top"i>rt<"bottom"flp><"clear">' 
            });

            $('.jobList').on('click', function(e){
                e.preventDefault();
                $('#jobListModal').modal('show');
            });

            $(document).on('click', '.takeJob', function(e){
                e.preventDefault();
                var jobId = $(this).data('id');

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('job.take', ':id') }}".replace(':id', jobId),
                    type: 'POST',
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            $('#jobListModal').modal('hide');
                            setTimeout(function() {
                                updateIndexView();
                            }, 500);
                        } else {
                            console.error("Error: Gagal mengambil pekerjaan.");
                        }
                    },
                    error: function(error) {
                        console.error("Error:", error);
                    }
                });
            });

            $('.btnCloseJob').on('click', function(e){
                e.preventDefault();
                $('#jobListModal').modal('hide');
            });
        });

        // For Handling auto run
        $('.autoRun').on('click', function(e){
            e.preventDefault();
            $('#modalAutorun').modal('show');
        });

        $(document).on('click', '#modalAutorun button',function(e) {
            e.preventDefault();

            var activity_name = $(this).data('activity_name');
            var user = {!! json_encode(Auth::user()) !!};
            var jobId = $(this).data('id');

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: "{{ route('member.autoRun', ':id') }}".replace(':id', jobId),
                data: { 
                    _token: "{{ csrf_token() }}", 
                    activity_name : activity_name,
                    user_id_mch: user.id_mch,
                    user_name: user.name
                }, 
                success: function(response) {
                    // Handle the success response here
                    $('#modalAutorun').modal('hide');

                    setTimeout(function () {
                        updateIndexView();
                        startStopwatch();
                        startBlinkAutorun();
                    }, 1000); // Menjalankan updateIndexView setelah 1 detik
                    setTimeout(function () {
                        $('#btnJobStart strong').text('JOB AUTO RUN');
                        $('#btnAutoRun strong').text('RUNNING');
                    }, 2000);
                },
                error: function(error) {
                    // Handle any errors here
                    console.error("Error starting job:", error);
                }
            });
        });

        function updateIndexView() {
            $.ajax({
                type: "GET",
                url: "{{ route('member.index') }}",
                success: function(response) {
                    // Replace the content of the index view with the updated content
                    $('.index-content').html($(response).find('.index-content').html());
                },
                error: function(error) {
                    console.error("Error updating index view:", error);
                }
            });
        }

        function formatTime(seconds) {
            var hours = Math.floor(seconds / 3600);
            var minutes = Math.floor((seconds % 3600) / 60);
            var secs = seconds % 60;
            return (
                (hours < 10 ? "0" : "") +
                hours +
                ":" +
                (minutes < 10 ? "0" : "") +
                minutes +
                ":" +
                (secs < 10 ? "0" : "") +
                secs
            );
        }

        function startStopwatch() {
            isStopwatchRunning = true;
            startTime = new Date().getTime() / 1000;
            stopwatchInterval = setInterval(function () {
                var currentTime = new Date().getTime() / 1000;
                var elapsedTime = Math.floor(currentTime - startTime);
                $("#durationTime").text(formatTime(elapsedTime));
            }, 1000);
        }

        function stopStopwatch() {
            isStopwatchRunning = false;
            clearInterval(stopwatchInterval);
            $('#durationTime').text('00:00:00');
        }
        
        function startBlink() {
            blinkInterval = setInterval(function() {
                $('.jobStart').toggleClass('btn-blink');
            }, 500);
        }

        function stopBlink() {
            clearInterval(blinkInterval);
            $('.jobStart').removeClass('btn-blink');
        }

        function startBlinkAutorun() {
            autoRunBlinkInterval = setInterval(function() {
                $('.autoRun').toggleClass('.btn-blinkAutoRun');
            }, 500);
        }

        function stopBlinkAutorun() {
            clearInterval(autoRunBlinkInterval);
            $('.autoRun').removeClass('.btn-blinkAutoRun');
        }

    });
</script>



