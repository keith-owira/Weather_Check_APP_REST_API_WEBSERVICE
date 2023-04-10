<?php

  $error='';
  $weather='';
  if(array_key_exists('submit',$_GET)){
    //checking if input is empty 
    if (!$_GET['city']){
      $error = "Sorry ,Your Input is empty";
    }

    if ($_GET['city']){
      $apiData = file_get_contents("https://api.openweathermap.org/data/2.5/weather?q=".$_GET['city']."&appid=0252d2f04a47e9858d57bf2eab8c58a1");
    
      $weatherArray=json_decode($apiData, true);

      if ($weatherArray['cod']==200){

        $tempCelcius = $weatherArray['main']['temp'] -273;
       
        $weather = "<b>".$weatherArray['name'].",".$weatherArray['sys']['country']." : ".intval($tempCelcius)." &deg;C</b><br>";
        $weather .= "<b> Weather Conditions: </b> ".$weatherArray['weather']['0']['description']."<br>";
        $weather .= "<b> Atmospheric Conditions: </b> ".$weatherArray['main']['pressure']." hPa </br>";
        $weather .= "<b> Wind Speed: </b> ".$weatherArray['wind']['speed']." meters\sec </br>";
  
        date_default_timezone_set('Africa/Nairobi');
        $sunrise = $weatherArray['sys']['sunrise'];
        $weather .= "<b> Sunrise: </b> ".date("F j, Y, g:i a" , $sunrise). "<br>";
        $weather .= "<b> Current Time: </b> ".date("F j, Y, g:i a" );
  

      }else{
        $error="Could not find the city. Invalid Input";
      }

    }
  }

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Weather App</title>
    <style>
      body{
        margin:0px;
        padding:0px;
        box-sizing:border-box;
        background-image:url(clouds-dawn-dramatic-1118873.jpg);
        color: white !important;
        font-family:"Times New Roman", Times, serif !important;
        font-size:large;
        background-size:cover;
        background-attachment:fixed;
      }

      .container{
        text-align : center;
        justify-content:center;
        align-items:center;
        width:440px;
      }

      h1{
        font-weight:700 !important;
        margin-top:150px !important;
      }

      input {
        width:350px;
        padding:5px;
      }
    
      

    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  </head>
  <body>
      <div class="container">
        <h1>Search Global Weather</h1>
        <form action = "" method = "GET">
          <p><label for = "city">Enter your city name</label></p>
          <p><input type = "text" name = "city" id = "city" placeholder = "City Name "></p>
          <button type = "submit" name = "submit" class="btn btn-success">Search</button>
          <p>
          <div class="output mt-3" >
            <?php
            if ($weather){
              echo '<div class="alert alert-success" role="alert">
             ' .$weather. '
          </div>';
            }
            if ($error){
              echo '<div class="alert alert-danger" role="alert">
             ' .$error. '
              </div>';
            }

            ?>
          </div>
    </p>
        </form>
      </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
  </body>
</html>