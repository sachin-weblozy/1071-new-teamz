<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<script>
  @php
  $userId = auth()->check() ? auth()->user()->id:0;
  @endphp  

  var pusher = new Pusher('f82f47cb619ccbb1282d', {
    cluster: 'ap2'
  });

  var channel = pusher.subscribe('my-channel');
  channel.bind("Illuminate\\Notifications\\Events\\BroadcastNotificationCreated", function(data) {
        
        if(data.user_id == {{$userId}}){
          showNotification();
          
            function showNotification() {
              const options = {
                body: data.body,
                icon: 'icon.png',
                vibrate: [200, 100, 200],
                tag: 'example-notification',
                renotify: true
              };
              
              const notification = new Notification(data.title, options);
        
              notification.onclick = function(event) {
                event.preventDefault(); // Prevent the browser from focusing the Notification's tab
                window.open(data.url, '_blank');
              };
        
              notification.onclose = function() {
                console.log('Notification closed');
              };
          }

        }
  });
</script>