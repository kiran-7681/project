<?php
   session_start();

   if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
      header("location: login.php");
      exit;
   }
   include 'config.php';
   $username = $_SESSION['username'];
   $movie_name = $_GET['variable1'];
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <script src="https://apis.google.com/js/client.js?onload=init"></script>
    <script type="text/javascript">
    	function getanswer(){
        var http = new XMLHttpRequest();
             http.onreadystatechange=function(){if(this.readyState== 4&this.status==200){
                details=JSON.parse(this.responseText);
                console.log(details);
                var reg = "/" + details.Title+"/";
                var search=details.Title+"Trailer";

                var xhttp=new XMLHttpRequest();
                xhttp.onreadystatechange=function(){
                    if(this.readyState==4&&this.status==200){
                        trailerdetails =JSON.parse(this.responseText);
                        console.log(trailerdetails);
                        var trailertitle=trailerdetails.items[0].id.videoId;
                        console.log(trailertitle);
                        document.getElementById('trailer').innerHTML='<iframe width="420" height="315"src="https://www.youtube.com/embed/'+trailertitle+'"></iframe>';
                        }
                }
                  var trailerurl='https://www.googleapis.com/youtube/v3/search?key=AIzaSyBLyncBI2M9S7rEZXyKflLKnEdDjmWaT5E&part=snippet&field=items&q='+search;
                  xhttp.open("GET",trailerurl,true);
                  xhttp.send();
                } 
               } 
             var url='http://www.omdbapi.com/?apikey=870d13d2&t=<?php echo $movie_name; ?>';
             http.open("GET",url,true);
             http.send();
            $.get("https://www.omdbapi.com/?t=<?php echo $movie_name; ?>&apikey=8ce7c01e", function(rawdata){
                var rawstring = JSON.stringify(rawdata);
                data = JSON.parse(rawstring);

                var title = data.Title;
                var year = data.Year;
                var imdburl = "https://www.imdb.com/title/"+data.imdbID+"/";
                var posterurl = data.Poster;
                var rated = data.Rated;
                var runtime = data.Runtime;
                var genre = data.Genre;
                var director = data.Director;
                var actor = data.Actors;
                var plot = data.Plot;
                var awards = data.Awards;
                var rating = data.imdbRating;
                var type = data.Type;
                var imdb = data.imdbID;
                document.getElementById('title').innerHTML="<h1>"+title+"</h1>"
                document.getElementById('poster').innerHTML="<img src= '"+posterurl+"'> ";
                document.getElementById('plot').innerHTML="<p><strong>Plot:</strong>"+plot+"</p>";
                document.getElementById('details').innerHTML="<p> <strong>Type:</strong>"+type+"</p> <p><strong> Year Released:</strong>"+year+"</p><p><strong> Rated: </strong>"+rated+"</p> <p><strong> Runtime:</strong>"+runtime+"</p> <p> <strong>Genre:</strong>"+genre+"</p> <p><strong> Director:</strong>"+director+"</p>  <p><strong>Actors:</strong>"+actor+"</p> <p><strong>Awards:</strong>"+awards+"</p> <p> <strong>Rating:</strong>"+rating+"</p>  <p> <strong>IMDB page:</strong> <a href='"+imdburl+"'target='_blank'>"+imdburl+"</a></p>";
                 }); 
        }
    </script>
    <style type="text/css">
             body{
                 background: url(m2.jpg) no-repeat;
                 background-size: cover;
             }
             *{
                box-sizing: border-box;
             }
             [class*="col-"] {
                float: left;
                padding: 15px;
             }
             .header{
                background-color: rgba(0,0,0,0.9);
                border-radius:30px;
             }
             .header h1{
                float: left;
                color: #00ff99;
             }
             .header p{
                float: right;
             }
             .header a{
                font-size: 20px;
                padding: 8px;
                text-decoration: none;
                margin:10px;
                border-radius: 20px;
                color: red;
                background-color: #ffcc66;
             }
             .nav ul{
                list-style-type: none;
                margin: 0;
                background: #ffcc66;
                padding: 14px;
                box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
                text-align: center;
                border-radius: 20px;
             }
             .nav li{
                padding: 8px;
                margin-bottom: 9px;
                background-color: #33b5e5;
                text-align: center;
                box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
                cursor: pointer;
             }
             .nav a{
                color: black;
                text-decoration: none;
                text-align: center;
                font-size: 25px;
             }
             .Search{
                margin-top: 20px;
                background-color: rgba(0,0,0,0.9);
                border-radius: 30px;
             }
             #poster img{
                width: 250px;
                padding: 20px;
                background: #cccccc;
                border-radius: 20px;
             }
             #trailer iframe{
                padding: 20px;
                background: #cccccc;
                border-radius: 20px;
                width: 400px;
                float: right;
             }
             #title{
                color: #4d79ff;
             }
             #plot,#details,#info{
                color: white;
             }
             #plot{
                font-size: 20px;
             }
             #details{
                font-size: 15px;
             }
             #details a{
                color: red;
             }
             [class*="col-"] {
                width: 100%;
             }
             @media only screen and (min-width: 768px) {
                /* For desktop: */
                .col-1 {width: 8.33%;}
                .col-2 {width: 16.66%;}
                .col-3 {width: 25%;}
                .col-4 {width: 33.33%;}
                .col-5 {width: 41.66%;}
                .col-6 {width: 50%;}
                .col-7 {width: 58.33%;}
                .col-8 {width: 66.66%;}
                .col-9 {width: 75%;}
                .col-10 {width: 83.33%;}
                .col-11 {width: 91.66%;}
                .col-12 {width: 100%;}
             }
    </style>
</head>
<body>
	<script type="text/javascript">
		getanswer();
	</script>
	<div class="header col-12">
        <h1>Welcome <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b></h1>
    <p>
        <a href="logout.php" class="btn1">SIGN OUT</a><br><br>
        <a href="reset-password.php" class="btn2">Reset Password</a><br>
    </p>
  </div>
  <div class="row">
        <div class="col-3 nav">
    <ul>
        <li><a href="welcome.php">Go Back</a></li>
        <li><a href="watchlaterlist.php">View watchlater</a></li>
        <li><a href="watchedlist.php">View watched content</a></li>
        <li><a href="viewcomments.php">View your comments</a></li>
    </ul>
        </div>
        <div class="col-8 Search">
	        <div id="title"></div>
          <div id="poster" class="col-3"></div>
          <div id="trailer" class="col-7"></div><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
	        <div id="plot"></div>
	        <div id="details"></div>
          <div id="info"></div>
          </div>
    </div>
</body>
</html>