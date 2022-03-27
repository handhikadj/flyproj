<div>
    <button id="check-button" class="btn-check">
        Check Ping
    </button>

    <div id="ping-result"></div>

    <script>
        let isPingInitiated = false;

        document.getElementById('check-button').onclick = () => {
          isPingInitiated = true;
        }

        setInterval(async () => {
          const startTime = new Date().getTime();

          if (isPingInitiated) {
            await fetch('/');

            const responseTime = new Date().getTime() - startTime;
            document.getElementById('ping-result').innerText = `${responseTime} ms`;
          }
        }, 1000);
    </script>
</div>
