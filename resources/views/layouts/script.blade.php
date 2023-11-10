<script>
    function updateClock() {
        var now = new Date();
        var day = now.toLocaleDateString('en-US', { weekday: 'long' });
        var date = now.getDate();
        var month = now.toLocaleDateString('en-US', { month: 'long' });
        var year = now.getFullYear();
        var hours = now.getHours().toString().padStart(2, '0');
        var minutes = now.getMinutes().toString().padStart(2, '0');
        var seconds = now.getSeconds().toString().padStart(2, '0');
        var time = hours + ':' + minutes + ':' + seconds;
        var fullDate = day + ', ' + date + ' ' + month + ' ' + year + ' | ' + time;

        document.getElementById('jamNavbar').textContent = fullDate;
    }

    // Panggil fungsi updateClock setiap detik (1000 ms)
    setInterval(updateClock, 1000);

    // Panggil fungsi updateClock sekali ketika halaman selesai dimuat
    $(document).ready(function () {
        updateClock();
    });
</script>

