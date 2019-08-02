<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
 
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$new_password = $confirm_password = "";
$new_password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate new password
    if(empty(trim($_POST["new_password"]))){
        $new_password_err = "Please enter the new password.";     
    } elseif(strlen(trim($_POST["new_password"])) < 6){
        $new_password_err = "Password must have atleast 6 characters.";
    } else{
        $new_password = trim($_POST["new_password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm the password.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($new_password_err) && ($new_password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
        
    // Check input errors before updating the database
    if(empty($new_password_err) && empty($confirm_password_err)){
        // Prepare an update statement
        $sql = "UPDATE users SET password = ? WHERE id = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "si", $param_password, $param_id);
            
            // Set parameters
            $param_password = password_hash($new_password, PASSWORD_DEFAULT);
            $param_id = $_SESSION["id"];
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Password updated successfully. Destroy the session, and redirect to login page
                session_destroy();
                header("location: login.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
    <style type="text/css">
        body{ 
            margin:0px;
            padding: 0px;
            font: 14px sans-serif;
            background: url(m2.jpg) no-repeat;
            background-size: cover;
            height: 900px;
        }
        .wrapper{
            position: absolute;
            top: 50%;
            left:50%;
            transform: translate(-50%,-50%);
            width:400px;
            padding:40px;
            background: rgba(0,0,0,.8);
            box-sizing: border-box;
            box-shadow: 0 15px 25px rgba(0,0,0,.5);
            border-radius: 10px;
        }
        .wrapper h1,p{
            text-align: center;
            color: white;
        }
        .wrapper .form-group{
            position: relative;
        }
        input{
            width: 50%;
            background: none;
            border: 2px solid #03a9f4;
            border-radius: 20px;
            padding: 10px;
            text-align: center;
        }
        .form-group{
            padding: 15px;
            position: absolute;
            left: 20%;
        }
        .wrapper input[type="submit"]{
            background: transparent;
            border:none;
            width: 30%;
            margin-left: 40px;
            position: middle;
            outline: none;
            background: #03a9f4;
            padding:7px 20px;
            cursor:pointer;
            border-radius: 15px;
            margin-bottom: 20px;
        }  
        a{
            color: red;
            font-size: 18px;
            margin-left: 55px;
        }
        .help-block{
            color: red;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <h1>Reset Password</h1>
        <p>Please fill out this form to reset your password.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 
            <div class="form-group <?php echo (!empty($new_password_err)) ? 'has-error' : ''; ?>">
                <input type="password" name="new_password" class="form-control" placeholder="Enter new password" value="<?php echo $new_password; ?>"><br>
                <span class="help-block"><?php echo $new_password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <input type="password" name="confirm_password" class="form-control" placeholder="re-enter passwrord"><br>
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn" value="Submit"><br>
                <a class="btn btn-link" href="welcome.php">Go Back</a>
            </div>
        </form>
    </div>    
</body>
</html>