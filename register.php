<?php
require_once "config.php";
 
$username = $email = $password = $confirm_password = "";
$username_err = $email_err = $password_err = $confirm_password_err = "";
 
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "* Please enter a username.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "* This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "* Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Validate Email
    if(empty(trim($_POST["email"]))){
        $email_err = "* Please enter an email id.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE email = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            
            // Set parameters
            $param_email = trim($_POST["email"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $email_err = "* This email id is already taken.";
                } else{
                    $email = trim($_POST["email"]);
                }
            } else{
                echo "* Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }   

    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "* Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "* Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "* Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "* Password did not match.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($email_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sss", $param_username, $param_email, $param_password);
            
            // Set parameters
            $param_username = $username;
            $param_email = $email;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: welcome.php");
            } else{
                echo "* Something went wrong. Please try again later.";
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
    <title>Sign Up</title>
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
            width:65%;
            border: 2px solid #03a9f4;
            border-radius: 20px;
            text-align: center;
            padding: 10px 0;
            font-size: 16px;
            color:#fff;
            margin-left: 60px;
            margin-bottom: 10px;
            margin-top: 20px;
            outline:none;
            background: transparent;
        }
        .wrapper input[type="text"]:hover, .wrapper input[type="email"]:hover, .wrapper input[type="password"]:hover{
            border-color: #4caf50;
        }
        .wrapper input[type="text"]:focus, .wrapper input[type="email"]:focus, .wrapper input[type="password"]:focus{
            border-color: #4caf50;
            margin-left: 35px;
            width: 80%;
        }
        .wrapper input[type="submit"], .wrapper input[type="reset"]{
            background: transparent;
            border:none;
            width: 36%;
            margin-left: 30px;
            margin-right: 10px;
            margin-top: 30px;
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
        .wrapper input[type="reset"]:hover{
            background: #4caf50;
            color: black;
            border-color: 2px solid #03a9f4;
        }
        .wrapper input[type="submit"]:focus, .wrapper input[type="reset"]:focus{
            background-color: black;
            color:white;
            border:2px solid #4caf50;
        }
        .help-block{
            color: red;
            font-size: 17px;
            margin-left: 70px;
        }
        .wrapper a{
            color: red;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>SIGN UP</h2>
        <p>Please fill this form to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <input type="text" name="username" placeholder = "Username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                <input type="email" name="email" placeholder = "Email" class="form-control" value="<?php echo $email; ?>">
                <span class="help-block"><?php echo $email_err; ?></span>
            </div>  
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <input type="password" name="password" placeholder = "Password" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <input type="password" name="confirm_password" placeholder = "Re-enter Password" class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
        </form>
    </div>    
</body>
</html>