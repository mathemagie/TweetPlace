
<!DOCTYPE html>
<head>
  <title>Pusher Test</title>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
  <script src="http://js.pusher.com/1.12/pusher.min.js" type="text/javascript"></script>
  <script type="text/javascript">
    // Enable pusher logging - don't include this in production
    Pusher.log = function(message) {
      if (window.console && window.console.log) window.console.log(message);
    };

    // Flash fallback logging - don't include this in production
    WEB_SOCKET_DEBUG = true;

    var pusher = new Pusher('6d6e276b32c15e5e131c');
    var channel = pusher.subscribe('status');
    channel.bind('my_event', function(data) {
      $('#status').html(data.status);
    });
  </script>
  <body>
    <div id='status'></div>
</head>
