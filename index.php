<!DOCTYPE html>
  <html>
    <head>
    <title>Groove Auto Push</title>
      <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
      <link rel="stylesheet" type="text/css" href="style.css">

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>
    <body style="background-color:#34495e;">
<body>
<nav>
    <div class="nav-wrapper">
      <ul id="nav-mobile" class="left hide-on-med-and-down">
        <li><a href="">Groove Auto Push</a></li>
      </ul>
    </div>
  </nav>

  <form action="curl_push.php" method="POST">
  <ul class="collapsible" data-collapsible="accordion">
  <li>
    <div class="collapsible-header">
      <i class="material-icons">lock</i>
      Big Commerce Info:
      <span class="badge"></span></div>
    <div class="collapsible-body"><p>
    <div class="row">
        <div class="input-field col s6">
            <input value="" id="client_id" type="text" class="validate" name="client_id">
                <label class="active" for="client_id">client id</label>
                 </div>
            </div>

            <div class="row">
        <div class="input-field col s6">
            <input value="" id="api_key" type="text" class="validate"   name="api_key">
                <label class="active" for="api_key">api key</label>
                 </div>
            </div>
            
            <div class="row">
        <div class="input-field col s6">
            <input value="" id="store_url" type="text" class="validate" name="store_url">
                <label class="active" for="store_url">store url</label>
                 </div>
            </div>

            <div class="row">
        <div class="input-field col s6">
            <input value="" id="store_id" type="text" class="validate"  name="store_id">
                <label class="active" for="store_id">store id</label>
                 </div>
            </div>
    </p>
    </div>
  </li>
  <li>
    <div class="collapsible-header">
      <i class="material-icons">vpn_key</i>
      WebDav Info:
      <span class="badge"></span></div>
    <div class="collapsible-body"><p>
    <div class="row">
        <div class="input-field col s6">
            <input value="" id="username" type="text" class="validate"     name="username">
                <label class="active" for="username">username</label>
                 </div>
            </div>

            <div class="row">
        <div class="input-field col s6">
            <input value="" id="password" type="password" class="validate" name="password">
                <label class="active" for="password">password</label>
                 </div>
            </div>
    
    </p></div>
  </li>
  <li>
    <div class="collapsible-header">
      <i class="material-icons">access_time</i>
      Site Push Time:
      <span class="badge"></span></div>
    <div class="collapsible-body"><p>
    <div class="input-field col s12">
    <input type="text" class="timepicker" name="time">

    <label>Select Push Time:</label>
  </div>
    </p></div>
  </li>
</ul>
                    <p class="center-align"></p>
                    <p class="center-align">
            <button class="button button1" type="submit" name="submit">create connection</button>
         </p>
</form>
      <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
      <script>
 
            $(document).ready(function() {
            $('select').material_select();

            $('.timepicker').pickatime({
              default: 'now', // Set default time: 'now', '1:30AM', '16:30'
              fromnow: 0,       // set default time to * milliseconds from now (using with default = 'now')
              twelvehour: false, // Use AM/PM or 24-hour format
              donetext: 'OK', // text for done-button
              cleartext: 'Clear', // text for clear-button
              canceltext: 'Cancel', // Text for cancel-button
              autoclose: false, // automatic close timepicker
              ampmclickable: true, // make AM PM clickable
              aftershow: function(){} //Function for after opening timepicker
                   });
     
                 });
        
    </script>
    </body>
  </html>
  