<?php

    session_start();
 
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
      header("location: login.php");
      exit;
    }

   include 'config.php';
   if(isset($_GET['name'])&&isset($_GET['id'])) {
   	$name = $_GET['name'];
   	$id = $_GET['id'];
   	$username = $_SESSION['username'];
    
    $sql = "SELECT * FROM watched WHERE username='$username' AND movie_name='$name'";
    $result=$link->query($sql);
    if($result){
    	if($result->num_rows>0){
    		echo "This movie is already added to watched movie collection";
    	}
    	else{
    		$sql="INSERT INTO watched(username,movie_name,movie_id) VALUES('$username','$name','$id')";
    		if($link->query($sql)==true) {
    			echo "Movie added to watched movie list";
    		}
    		else{
    			echo "an error occured".$link->error;
    		}
    	}
    }
   }
?>