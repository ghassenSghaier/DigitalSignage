<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>SNTRI</title>

    <!-- Bootstrap -->
    <link href="{{asset('/')}}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{asset('/')}}/css/main.css" rel="stylesheet">
    <link href="{{asset('/')}}/css/animate.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
   
<div class="container-fluid">
  <div class="logo row">
    <img src="{{asset('/')}}/img/logo.png" alt="">
  </div>

  <div class="row">
    <div class="col-md-8 video-container">
    @if(isset($bus->ads[0]))
      <video src="{{asset('/video')}}/{{$bus->ads[0]->video}}" autobuffer autoloop loop  autoplay="true"></video>
    @else
      <video src="{{asset('/video')}}/videoplayback.mp4" autobuffer autoloop loop  autoplay="true"></video>
    @endif
    </div>

    <div class="col-md-4">

      <div class="weather">
        <div class="row">
          <div class="col-xs-6">
          <h2><strong>Tunis</strong></h2>
          <p class="time"> 10:02</p>
          <p class="v-align">
          <img src="{{asset('/')}}/img/sun.png" alt=""> <big>35°</big>
          </p>
          </div>
          <div class="col-xs-6 text-right">
          <h2><strong>Samedi</strong></h2>
          <p class="slim">06 Mai</p>

          <h1><strong>Ensoleillé</strong></h1>
          <p class="bas"><i class="fa fa-angle-down" aria-hidden="true"></i> 10 <i class="fa fa-angle-down" aria-hidden="true"></i>20</p>
          </div>
        </div>
      </div>
    <!--weather-->
      <div class="weather">
        <div class="row">
          <div class="col-xs-6">
    
          <p class="v-align">
          <img src="{{asset('/')}}/img/sun.png" alt=""> <big>37°</big>
          </p>
          </div>
          <div class="col-xs-6 text-right">
          <h2><strong>Diamanche</strong></h2>
          <p class="slim">07 Mai</p>
        </div>

      </div>
    </div>
    <!--weather-->

  
     <div id="map" style="height: 305px; margin-top:20px; width: 100%"></div>

  </div>
<div class="col-md-12">

  <div class="well">
    <marquee direction="right"  behavior="alternate" scrollamount="1" class="qus" >
     <?php

    $xmlfile = simplexml_load_file('http://www.mosaiquefm.net/ar/rss');

    foreach ($xmlfile->xpath('//item') as $item) {
      
        echo "<span class='glyphicon glyphicon-option-horizontal'></span>" .$item->description  ."<span class='glyphicon glyphicon-option-horizontal'></span>"   ;
    } 


    ?>
    </marquee>
  </div>
</div>
</div>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.min.js"></script>
    <script src="js/wow.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script type="text/javascript">
     /* var reload = 30*60*1000; //half hour
      var i = 1;
      setInterval(function(){ 

          location.reload();

      }, reload);*/

@if(isset($bus->ads[0]))
      setTimeout(function(){ 

          location.reload();
          <?php 
        $timeFirst  = strtotime(date("Y-m-d H:i:s"));
        $timeSecond = strtotime($bus->ads[0]->end);
        $difference = $timeSecond - $timeFirst;

        ?>
      }, {{$difference*1000}});

@endif
//function animation
function addAnimation(elemenAnim, styleAnim, plus) {
    $(elemenAnim).each(function() {
        var delay = $(this).index() * 0.2 + plus;
        $(this).addClass(styleAnim + ' wow').attr('data-wow-delay', delay + 's');
    });
}
addAnimation('video, .weather, #map', 'zoomIn', 0.3);
addAnimation('.well', 'fadeInUp', 0.3);
    new WOW().init();

    </script>
    
    <script>
      function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 12,
          center: {lat: -28.643387, lng: 153.612224},
          mapTypeControl: true,
          mapTypeControlOptions: {
              style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
              position: google.maps.ControlPosition.TOP_CENTER
          },
          zoomControl: true,
          zoomControlOptions: {
              position: google.maps.ControlPosition.LEFT_CENTER
          },
          scaleControl: true,
          streetViewControl: true,
          streetViewControlOptions: {
              position: google.maps.ControlPosition.LEFT_TOP
          },
          fullscreenControl: true
        });
      }
    </script>
 <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCV4vdc8o4u6qKyfcOEDk_t5OxLKcxBuFo&callback=initMap">
    </script>

  </body>
</html>