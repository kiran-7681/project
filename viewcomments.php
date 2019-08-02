<?php
   session_start();
 
   if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
      header("location: login.php");
      exit;
   }
   include 'config.php';
   $username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html>
<head>
	<title>Your Comments</title>
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
                text-align: center;
                padding: 5px;
                color: #03a9f4;
             }
             .header h2{
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
             table{
                padding: 20px;
                border-radius: 10px;
             }
             thead , tbody {
                text-align: center;
                padding: 20px;
             }
             tr{
                background-color: #f2f2f2;
            }
            th{
                background-color: #4caf50;
                color: white;
                font-size: 30px;
            }
            a{
                text-decoration: none;
                color: black;
                font-size: 20px;
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
  <div class="header col-12">
  <h1>Your comments</h1>
	<h2>Welcome <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b></h2>
  <p>
        <a href="logout.php" class="btn1">SIGN OUT</a><br><br>
        <a href="reset-password.php" class="btn2">Reset Password</a><br>
  </p>
  </div>
  <div class="row">
        <div class="col-3 nav">
    <ul>
        <li><a href="welcome.php">Go Back</a></li>
        <li><a href="watchlaterlist.php">View Watch Later</a></li>
        <li><a href="watched.php">View Watched</a></li>
    </ul>
        </div>
 	<?php 
        $sql = "SELECT * FROM comments WHERE username='$username'";
        $result=$link->query($sql);?>

        <table border="1">
        	<thead>
        		<th>Sl.No</th>
        		<th>Movie Name</th>
        		<th>Comment</th>
        	</thead>
        	<tbody>
        		<?php
        		  if($result) {
        		  	$i=1;
        		  	while($row = $result->fetch_assoc()) {?>
        		  		<tr>
        		  			<td><?php echo $i;?></td>
        		  			<td><?php echo $row['movie_name'];?></td>
        		  			<td><?php echo $row['comments']; ?></td>
        		  		</tr>
        		  		<?php $i++;
        		  	}?>
        		  <?php }?>
        	</tbody>
        </table>
      </div>
</body>
</html>