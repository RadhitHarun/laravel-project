// refresh page setiap 5 detik
// (function () {
//     setTimeout(function () {
//         location.reload();
//     }, 5000); // 5000 milidetik (5 detik)
// })();

function refreshData() {
    $.ajax({
        url: "{{ route('products.index') }}",
        type: "GET",
        success: function (data) {
            $('#content-container').html(data);
        },
        error: function (xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
}

setInterval(refreshData, 5000);


