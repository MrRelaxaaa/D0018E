<?php
// Include config file
require_once 'config.php';
// Define variables and initialize with empty values
$username = $firstname = $lastname = $email = $address = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
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
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
            mysqli_stmt_close($stmt);
        }
        // Close statement
       // mysqli_stmt_close($stmt);
    }
    // Validate password
    if(empty(trim($_POST['password']))){
        $password_err = "Please enter a password.";
    } elseif(strlen(trim($_POST['password'])) < 3){
        $password_err = "Password must have atleast 3 characters.";
    } else{
        $password = trim($_POST['password']);
    }

    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
            // Set parameters
            $param_username = $username;
            $param_password = $password; //password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: login.html");
            } else{
                echo "Login error wtf?";
            }

        }
        // Close statement
        mysqli_stmt_close($stmt);
    }
    // Close connection
    mysqli_close($link);
}
?>

<!-- Kommentar -->
<!DOCTYPE html>
<html lang="sv">
	<head>
		<link rel="stylesheet" href="test.css">
		<meta charset="utf-8">
		<title>test</title>
	</head>
	<body>
		<div class="bread-container">
      <div class="registration-box">
        <div class="registration-holder">
          <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
          <input type='text' placeholder="firstname" name="firstname" id='firstname' maxlength="50" value="<?php echo $firstname; ?>" required/>
          <br>
          <br>
          <input type='text' placeholder="lastname" name="lastname" id='lastname' maxlength="50" value="<?php echo $lastname; ?>" required/>
          <br>
          <br>
          <input type='text' placeholder="username" name="username" id='username' maxlength="50" value="<?php echo $username; ?>" required/>
					<br>
          <br>
          <input type='password' placeholder="password" name="password" id='password' maxlength="50" value="<?php echo $password; ?>" required/>
					<br>
          <br>
          <input type='text' placeholder="e-mail" name="email" id='email' maxlength="50" value="<?php echo $email; ?>" required/>
					<br>
          <br>
          <input type='text' placeholder="address" name="address" id='address' maxlength="50" value="<?php echo $address; ?>" required/>
					<br>
          <br>
          <input type="submit" name="Submit" class="button" value="Register">
        </form>
        </div>
      </div>
		</div>
	</body>
</html>
