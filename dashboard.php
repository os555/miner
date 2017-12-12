<style>
    body {background-color: #b0bec5 ;}
    .custcontainer {
        width: 95%;
        margin: 0 auto;    
    }
</style>
<head>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script type="text/javascript" src="dist/js/raphael.js"></script>
    <script type="text/javascript" src="dist/js/justgage.js"></script>
    <script src="dist/js/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <title>Miner Monitoring Dashboard</title>
<header>
<div class="wrapper navbar-fixed">
<!-- TOP NAV BAR !-->   
<nav>
  <div class="nav-wrapper blue-grey darken-4">
    <a href="#" data-activates="slide-out" class=" button-collapse show-on-large"><i class="material-icons">menu</i></a>
  </div>
</nav>
</div>
<!-- END TOP NAV BAR !-->   
<!-- SIDE NAVIGATION BAR !-->
  <ul id="slide-out" class="side-nav blue-grey darken-2">
    <li><div class="user-view">
      <div class="background blue-grey lighten-5"></div>
      <a href="#!user"><img class="responsive-img" src="images/logo.png"></a>
      <p class="center-align" style="color: black;">Miners monitoring dashboard</p>
    </div></li>
    <li class="active"><a href="#!" onclick="loadmain();"><i class="material-icons">dashboard</i>Main</a></li>
    <li><a href="#!" onclick="loadmonit();"><i class="material-icons">ac_unit</i>Temperatures</a></li>
    <li><a href="#!" onclick="loadconfig();"><i class="material-icons">settings</i>Configuration</a></li>  
  </ul>
<!-- END SIDE NAVIGATION BAR !-->
</header>
</head>
<body>
<div class="custcontainer">
<!-- Page Content goes here -->
</div>
</body>
<script>
$(".button-collapse").sideNav({
      closeOnClick: true, // Closes side-nav on <a> clicks, useful for Angular/Meteor
      draggable: true // Choose whether you can drag to open on touch screens
    });
function loadmain(){$(".custcontainer").load("pages/main.html");}
function loadmonit(){$(".custcontainer").load("pages/tempmon.html");}
function loadmonitold(){$(".custcontainer").load("pages/miner.php");}
function loadconfig(){$(".custcontainer").load("pages/config.html");}
$(document).ready(loadmain());
</script>
<script type="text/javascript" src="dist/js/miner.js"></script>