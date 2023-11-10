// unused script.js in 

// script for adding "A" in front of input in id_job form
    // Tambahkan event listener pada saat formulir dikirim
    // document.querySelector('form').addEventListener('submit', function(event) {
    //     var idJobInput = document.getElementById('id_job').value;
    //     if (idJobInput.length !== 7 || !idJobInput.startsWith('A')) {
    //         event.preventDefault(); // Mencegah pengiriman formulir
    //         Swal.fire({
    //             icon: 'error',
    //             title: 'Oops...',
    //             text: 'ID JOB harus memiliki panjang 6 karakter dan dimulai dengan huruf "A"!',
    //         });
    //     }
    // });

    // {{-- <script>
    //     $(document).ready(function () {
    //         // Tangani event klik pada tombol-tombol di dalam modal downtime
    //         $('#downtimeModal button').on('click', function () {
    //             var keterangan = $(this).data('keterangan'); // Ambil nilai keterangan dari tombol yang diklik
    
    //             // Kirim form menggunakan AJAX
    //             $.ajax({
    //                 url: "{{ route('downtime.submit') }}",
    //                 type: "POST",
    //                 data: {
    //                     _token: $('meta[name="csrf-token"]').attr('content'),
    //                     activity_name: keterangan
    //                 },
    //                 success: function (response) {
    //                     console.log(response); // Anda bisa melakukan sesuatu setelah sukses submit
    
    //                     // Tampilkan modal notifikasi
    //                     $('#notifModal').modal('show');
    //                 },
    //                 error: function (xhr, status, error) {
    //                     console.log(xhr.responseText); // Log pesan error jika ada
    //                 }
    //             });
    //         });
    //     });
    // </script> --}}

    // {{-- <script>
    //     $(document).ready(function() {
    //         $('#table-index').DataTable({
    //             processing: true,
    //             serverside: true,
    //             ajax: "{{ route('project.index') }}",
    //             columns: [{
    //                 data: 'DT_RowIndex',
    //                 name: 'DT_RowIndex',
    //                 orderable: false,
    //                 searchable: false
    //             }, {
    //                 data: 'project',
    //                 name: 'project'
    //             }, {
    //                 data: 'Anumber',
    //                 name: 'Anumber'
    //             }, {
    //                 data: 'aksi',
    //                 name: 'Aksi'
    //             }]
    //         });
    //     });
    
    //     // GLOBAL SETUP 
    //     $.ajaxSetup({
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         }
    //     });
    
    //     // 02_PROSES SIMPAN 
    //     $('body').on('click', '#addProject', function(e) {
    //         e.preventDefault();
    //         $('#exampleModal').modal('show');
    //         $('.tombol-simpan').click(function() {
    //             simpan();
    //         });
    //     });
    
    //     // 03_PROSES EDIT 
    //     $('body').on('click', '.tombol-edit', function(e) {
    //         var id = $(this).data('id');
    //         $.ajax({
    //             url: "{{ route('project.edit') }}",
    //             type: 'GET',
    //             success: function(response) {
    //                 $('#exampleModal').modal('show');
    //                 $('#project').val(response.result.project);
    //                 $('#Anumber').val(response.result.Anumber);
    //                 console.log(response.result);
    //                 $('.tombol-simpan').click(function() {
    //                     simpan(id);
    //                 });
    //             }
    //         });
    //     });
    
    
    //     // 04_PROSES Delete 
    //     $('body').on('click', '.tombol-del', function(e) {
    //         if (confirm('Yakin mau hapus data ini?') == true) {
    //             var id = $(this).data('id');
    //             $.ajax({
    //                 url: "{{ route('project.destroy',['id'=>$data->id]) }}",
    //                 type: 'DELETE',
    //             });
    //             $('#table-index').DataTable().ajax.reload();
    //         }
    //     });
    
    //     // fungsi simpan dan update
    //     function simpan(id = '') {
    //         if (id == '') {
    //             var var_url = "{{ route('project.store') }}";
    //             var var_type = 'POST';
    //         } else {
    //             var var_url = "{{ route('project.update', ['id'=>$data->id]) }}";
    //             var var_type = 'PUT';
    //         }
    //         $.ajax({
    //             url: var_url,
    //             type: var_type,
    //             data: {
    //                 project: $('#project').val(),
    //                 Anumber: $('#Anumber').val()
    //             },
    //             success: function(response) {
    //                 if (response.errors) {
    //                     console.log(response.errors);
    //                     $('.alert-danger').removeClass('d-none');
    //                     $('.alert-danger').html("<ul>");
    //                     $.each(response.errors, function(key, value) {
    //                         $('.alert-danger').find('ul').append("<li>" + value +
    //                             "</li>");
    //                     });
    //                     $('.alert-danger').append("</ul>");
    //                 } else {
    //                     $('.alert-success').removeClass('d-none');
    //                     $('.alert-success').html(response.success);
    //                 }
    //                 $('#table-index').DataTable().ajax.reload();
    //             }
    
    //         });
    //     }
    
    //     $('#exampleModal').on('hidden.bs.modal', function() {
    //         $('#project').val('');
    //         $('#Anumber').val('');
    
    //         $('.alert-danger').addClass('d-none');
    //         $('.alert-danger').html('');
    
    //         $('.alert-success').addClass('d-none');
    //         $('.alert-success').html('');
    //     });
    // </script> --}}

    // {{-- StartJob --}}
    // {{-- <script>
    //     $(document).ready(function () {
    //         $('#anForm button').click(function (e) {
    //             var activity_name = $(this).data('activity_name');
    //             var job_id = $(this).data('job_id');
    //             var user = {!! json_encode(Auth::user()) !!};
    
    //             $('#job_id').val(job_id);
        
    //             $.ajax({
    //                 url: "{{ route('member.start', ':job_id') }}".replace(':job_id', job_id),
    //                 type: "POST",
    //                 dataType: 'json',
    //                 data: {
    //                     _token: $('meta[name="csrf-token"]').attr('content'),
                        
    //                     activity_name: activity_name,
    //                     user_id_mch: user.id_mch,
    //                     user_name:user.name,
    //                     user_sub:user.sub,
    //                     job_id: job_id
    //                 },
    //                 success: function (data) {
    //                     $('#startJob').modal('hide');
    //                     $('#pesanSukses').removeClass('d-none');
        
    //                     setTimeout(function () {
    //                         $('#pesanSukses').addClass('d-none');
    //                     }, 3000);
    //                 },
    //                 error: function (errorData) {
    //                     console.log('Error:', errorData);
    //                 }
    //             });
    //         });
    //     });
    // </script> --}}

    // {{-- <script>
    //     $(document).ready(function () {
    //     // Tangani event klik pada tombol-tombol di dalam modal downtime
    //     $('#downtimeModal button').on('click', function () {
    //         var keterangan = $(this).data('keterangan'); // Ambil nilai keterangan dari tombol yang diklik
    //         var user = {!! json_encode(Auth::user()) !!}; // Ambil informasi user yang sedang login
    
    //         // Kirim form menggunakan AJAX
    //         $.ajax({
    //             url: "{{ route('downtime.submit') }}",
    //             type: "POST",
    //             data: {
    //                 _token: $('meta[name="csrf-token"]').attr('content'),
    //                 activity_name: keterangan,
    //                 user_id_mch: user.id_mch, // Menggunakan data dari user yang sedang login
    //                 user_name: user.name // Menggunakan data dari user yang sedang login
    //             },
    //             success: function (response) {
    //                 console.log(response); // Anda bisa melakukan sesuatu setelah sukses submit
    
    //                 // Tampilkan modal notifikasi
    //                 $('#notifModal').modal('show');
    //             },
    //             error: function (xhr, status, error) {
    //                 console.log(xhr.responseText); // Log pesan error jika ada
    //             }
    //         });
    //     });
    // });
    // </script> --}}


// {{-- downtime --}}
// {{-- <script>
//     $(document).ready(function () {
//         // Tangani event klik pada tombol-tombol di dalam modal downtime
//         $('#downtimeModal button').on('click', function () {
//             var idActivity = $(this).data('id-activity');
//             var keterangan = $(this).data('keterangan'); // Ambil nilai keterangan dari tombol yang diklik

//             // Setel isi modal notifikasi sesuai dengan keterangan yang dipilih
//             $('#keteranganNotifikasi').text('Saat ini sedang ' + keterangan);

//             var user = {!! json_encode(Auth::user()) !!}; // Ambil informasi user yang sedang login

//             // Kirim form menggunakan AJAX
//             $.ajax({
//                 url: "{{ route('downtime.submit') }}",
//                 type: "POST",
//                 data: {
//                     _token: $('meta[name="csrf-token"]').attr('content'),
//                     id_activity:idActivity,
//                     activity_name: keterangan,
//                     user_id_mch: user.id_mch, // Menggunakan data dari user yang sedang login
//                     user_name: user.name // Menggunakan data dari user yang sedang login
//                 },
//                 success: function (response) {
//                     console.log(response); // Anda bisa melakukan sesuatu setelah sukses submit

//                     // Tampilkan modal notifikasi
//                     $('#notifModal').modal('show');
                    
//                     // // Tangani penutupan modal notifikasi saat tombol "Selesai" ditekan
//                     $('#btnSelesai').on('click', function () {

//                         $('#notifModal').modal('hide'); // Menutup modal notifikasi
//                     });
//                 },
//                 error: function (xhr, status, error) {
//                     console.log(xhr.responseText); // Log pesan error jika ada
//                 }
//             });
//         });
//     });
// </script> --}}

// {{-- idle --}}
// {{-- <script>
//     $(document).ready(function () {
//         // Tangani event klik pada tombol-tombol di dalam modal downtime
//         $('#idleModal button').on('click', function () {
//             var idActivity = $(this).data('id-activity');
//             var keterangan = $(this).data('keterangan'); // Ambil nilai keterangan dari tombol yang diklik

//             // Setel isi modal notifikasi sesuai dengan keterangan yang dipilih
//             $('#keteranganNotifikasi').text('Saat ini sedang ' + keterangan);

//             var user = {!! json_encode(Auth::user()) !!}; // Ambil informasi user yang sedang login

//             // Kirim form menggunakan AJAX
//             $.ajax({
//                 url: "{{ route('downtime.submit') }}",
//                 type: "POST",
//                 data: {
//                     _token: $('meta[name="csrf-token"]').attr('content'),
//                     id_activity:idActivity,
//                     activity_name: keterangan,
//                     user_id_mch: user.id_mch, // Menggunakan data dari user yang sedang login
//                     user_name: user.name // Menggunakan data dari user yang sedang login
//                 },
//                 success: function (response) {
//                     console.log(response); // Anda bisa melakukan sesuatu setelah sukses submit

//                     // Tampilkan modal notifikasi
//                     $('#notifModal').modal('show');
                    
//                     // // Tangani penutupan modal notifikasi saat tombol "Selesai" ditekan
//                     $('#btnSelesai').on('click', function () {

//                         $('#notifModal').modal('hide'); // Menutup modal notifikasi
//                     });
//                 },
//                 error: function (xhr, status, error) {
//                     console.log(xhr.responseText); // Log pesan error jika ada
//                 }
//             });
//         });
//     });
// </script> --}}
