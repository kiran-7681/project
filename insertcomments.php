<?php

    session_start();
 
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
      header("location: login.php");
      exit;
    }

   include 'config.php';
   if (isset($_GET['moviename'])&&isset($_GET['comment'])) {
   	$username = $_SESSION['username'];
   	$moviename = $_GET['moviename'];
   	$comment = $_GET['comment'];

   	$sql = "INSERT INTO comments(username,movie_name,comments) VALUES ('$username','$moviename','$comment')";
   	if($link ->query($sql)){
   		echo "your comment was added";
   	}
   	else{
   		echo $link->error;
   	}
   }

?>