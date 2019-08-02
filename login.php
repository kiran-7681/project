<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: welcome.php");
    exit;
}
 
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "  Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "  Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, username, password FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;                            
                            
                            // Redirect user to welcome page
                            header("location: welcome.php");
                        } else{
                            // Display an error message if password is not valid
                            $password_err = "   The password you entered was not valid.";
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = "   No account found with that username.";
                }
            } else{
                echo "   Oops! Something went wrong. Please try again later.";
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
    <title>Login</title>
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
        .wrapper h2,p{
            margin: 0 0 30px;
            padding:0;
            color: #fff;
            text-align: center;
        }
        .wrapper .form-group{
            position: relative;
        }
        .wrapper .form-group input{
            width:71%;
            border: 2px solid #03a9f4;
            border-radius: 20px;
            text-align: center;
            padding: 10px 0;
            font-size: 16px;
            color:#fff;
            margin-left: 45px;
            margin-top: 20px;
            margin-bottom: 10px;
            outline:none;
            background: transparent;
        }
        .wrapper input[type="text"]:hover, .wrapper input[type="password"]:hover{
            border-color: #4caf50;
        }
        .wrapper input[type="text"]:focus, .wrapper input[type="password"]:focus{
            border-color: #4caf50;
            margin-left: 18px;
            width: 90%;
        }
        .wrapper input[type="submit"]{
            background: transparent;
            border:none;
            width: 30%;
            margin-left: 120px;
            position: middle;
            outline: none;
            background: #03a9f4;
            padding:7px 20px;
            cursor:pointer;
            border-radius: 15px;
        }       
        .wrapper input[type="submit"]:hover{
            background: #4caf50;
            color: black;
            border-color: 2px solid #03a9f4;
        }
        .wrapper input[type="submit"]:focus{
            background-color: black;
            color: white;
            border: 2px solid #4caf50;
        }
        .wrapper a{
            color: red;
        }
        .help-block{
            color: red;
            font-size: 18px;
            margin-left: 50px;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Login</h2>
        <p>Please fill in your credentials to login.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <input type="text" name="username" placeholder = "Username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <input type="password" name="password" placeholder = "Password" class="form-control">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
            <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
        </form>
    </div>    
</body>
</html>