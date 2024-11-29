<h2>Payment Gateway</h2>
<h4>Redirecting in <span id="countdown">5</span> seconds...</h4>
<script>
    var seconds = 5;
    var countdown = document.getElementById('countdown');
    const interval = setInterval(function() {
        seconds--;
        countdown.textContent = seconds;
        if (seconds <= 0) {
            clearInterval(interval);
            window.location.href = '/E-care/public/paymentsuccessfulpage';
        }
    }, 1000);
</script>