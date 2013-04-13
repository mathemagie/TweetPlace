<!DOCTYPE html><html>
  <head>
    <meta charset="utf-8">
    <title>La Tapisserie</title>
    <link href="lieu.css" rel="stylesheet">
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
     <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script>
      function initialize() {
        var fenway = new google.maps.LatLng(48.858852,2.381448);
        var panoOptions = {
    			pov: {
    			heading: 250,
    			pitch: 1,
    			zoom: -1
    			},
          position: fenway,
          addressControlOptions: {
            position: google.maps.ControlPosition.BOTTOM
          },
          linksControl: false,
          panControl: false,
          zoomControlOptions: {
            style: google.maps.ZoomControlStyle.SMALL
          },
          enableCloseButton: false
        };

        var panorama = new google.maps.StreetViewPanorama(
            document.getElementById('pano'), panoOptions);
      }


    </script>
 
  
  <script type="text/javascript">

	function get_tap_status() {
	   $.ajax({
	    url : '/status',
	    success : function(data){
		      if (data == 1) {
				  $('#status_tapisserie').css('background','#33FF00');
		    }else {
				 $('#status_tapisserie').css('background','red');
		     }

	    } //votre callback
	      });
	}


	function get_status() {
		timeOut = setTimeout('get_status()', 2000);//It calls itself every 200ms
		get_tap_status();
	}

	$(document).ready(function() {
		//get_status();
	});



  </script>
    <script src="http://js.pusher.com/2.0/pusher.min.js" type="text/javascript"></script>
  <script type="text/javascript">
    // Enable pusher logging - don't include this in production
    Pusher.log = function(message) {
      if (window.console && window.console.log) window.console.log(message);
    };

    // Flash fallback logging - don't include this in production
    WEB_SOCKET_DEBUG = true;

    var pusher = new Pusher('15b20d20432e58d9debf');
    var channel = pusher.subscribe('tapisserie');
    channel.bind('is_open', function(data) {
        if (data == 1) {
              $('#status_tapisserie').css('background','#33FF00');
        }else {
              $('#status_tapisserie').css('background','red');
        }
    });
  </script>

  </head>
  <body onload="initialize()">
    <div id="pano_container">
      <div id="pano" style="width: 100%; height: 700px"></div>
    </div>
    <div id="status_tapisserie"></div>
  </body>
</html>

