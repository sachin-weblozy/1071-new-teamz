// Create a new Date object
const today = new Date();

// Get the day of the week
const daysOfWeek = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
const dayOfWeek = daysOfWeek[today.getDay()];

// Get the date
const date = today.getDate();

// Get the month
const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
const month = months[today.getMonth()];

// Get the full year
const year = today.getFullYear();

// Combine them into a formatted string
const formattedDate = `${month} ${date}, ${year}`;
const formattedDay = `${dayOfWeek}`;

// Print the date to the span with id="date"
document.getElementById('headerday').textContent = formattedDay;
document.getElementById('headerdate').textContent = formattedDate;


// notification
$( document ).ready(function() {
    if (Notification.permission === 'default') {
        Notification.requestPermission().then(function(permission) {
          if (permission === 'granted') {
            // showNotification();
          }
        });
    } else if (Notification.permission === 'granted') {
        // showNotification();
    } else {
        console.error('Notification permission denied');
    }
});
// notification end