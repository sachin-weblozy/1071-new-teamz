<div>
    @if($signInTime)
        <h5 id="timer" class="text-muted">00:00:00</h5>
    @endif
    
    <script>
            @if($signInTime)
                // Convert sign-in time string to milliseconds
                const signInTime = Date.parse('{{ $signInTime }}');
    
                // Function to update the timer
                function updateTimer() {
                    const currentTime = new Date().getTime();
    
                    // Calculate the time difference in milliseconds
                    const difference = currentTime - signInTime;
    
                    // Convert difference to hours, minutes, and seconds
                    let hours = Math.floor(difference / (1000 * 60 * 60));
                    let minutes = Math.floor((difference % (1000 * 60 * 60)) / (1000 * 60));
                    let seconds = Math.floor((difference % (1000 * 60)) / 1000);
    
                    // Format the time
                    const timeDifference = (hours < 10 ? "0" + hours : hours) + ":" +
                                           (minutes < 10 ? "0" + minutes : minutes) + ":" +
                                           (seconds < 10 ? "0" + seconds : seconds);
    
                    // Update the timer element
                    const timerElement = document.getElementById('timer');
                    timerElement.textContent = timeDifference;
    
                    // Call this function every second
                    setTimeout(updateTimer, 1000);
                }
    
                // Call the function to start the timer
                updateTimer();
            @endif
    </script>
</div>
