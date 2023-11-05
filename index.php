<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="logincss.css">
<style>
    .login-wrap {
    width: 100%;
    margin: auto;
    max-width: 500px;
    min-height: 630px;
    position: absolute;
    top: 10%;
    left: 65%;
    border-radius: 54px;
      }
      .slogan{
  font-size: 32px;
  font-family: Arial, Helvetica, sans-serif;
  top: 22%;
  position: absolute;
  color: black;
  margin-left: 55px;
}


</style>

</head>
<body>
<div class="login_banner">
        <img src="mini2.jpg" style="filter: blur(2px);"x width="100%" height="100%">
<div class="reg" style="position: absolute;">

    <h1>Registerly</h1>
    </div>
    <div class="slogan">
      <p>Welcome to Registerly – Your Memories, Our Records</p>
    </div>
    <div class="log_info">
      <p>At Registerly, we're dedicated to simplifying the management of marriage records.<br> 
        <br>
        Our user-friendly platform is designed to empower administrators and organizations <br>
        <br>
        with a secure, efficient, and accessible way to store and access vital <br>
        <br>
        marriage details.........</p>
 </div>
</div>

<!--  login in box -->
<form method="post" action="index.php">
   
  <div class="login-wrap">
    <div class="login-html">
      <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Sign In</label>
      <input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">Sign Up</label>
      <div class="login-form">
        <form method="post" action="index.php">
        <div class="sign-in-htm">
          <div class="group">
            <label for="user" class="label">Username</label>
            <input id="login_username" type="text" class="input" name="login_username" >
          </div>
          <div class="group">
            <label for="pass" class="label">Password</label>
            <input id="login_password" type="password" class="input" data-type="password" name="login_password">
          </div>
          <div class="group">
            <input id="check" type="checkbox" class="check" checked>
            <label for="check"><span class="icon"></span> Keep me Signed in</label>
          </div>
          <div class="group">
            <input type="submit" class="button" value="Sign In" name="signin">
          </div>
          <div class="hr"></div>
          <div class="foot-lnk">
            <a href="#forgot">Forgot Password?</a>
          </div>
        </div>
        </form>
        
        <form method="post" action="index.php"></form>
        <div class="sign-up-htm">
          <div class="group">
            <label for="user" class="label">Username</label>
            <input id="signup_username" type="text" class="input" name="signup_username">
          </div>
          <div class="group">
            <label for="pass" class="label">Password</label>
            <input id="signup_password" type="password" class="input" data-type="password" name="signup_password">
          </div>
          <div class="group">
            <label for="pass" class="label">Repeat Password</label>
            <input id="pass" type="password" class="input" data-type="password">
          </div>
          <div class="group">
            <label for="pass" class="label">Email Address</label>
            <input id="pass" type="text" class="input">
          </div>
          <div class="group">
            <input type="submit" class="button" value="Sign Up" name="signup">
          </div>
          <div class="hr"></div>
          <div class="foot-lnk">
            <label for="tab-1">Already Member?</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>

<?php
    // PHP code for sign-up and table creation
    if (isset($_POST['signup'])) {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "form";

        $conn = mysqli_connect($servername, $username, $password, $database);

        if (!$conn) {
            die("Sorry we failed to connect: " . mysqli_connect_error());
        }

        $username = mysqli_real_escape_string($conn, $_POST['signup_username']);
        $password = mysqli_real_escape_string($conn, $_POST['signup_password']);
        

        // Check if the username already exists in the users table
        $check_query = "SELECT * FROM users WHERE username = '$username'";
        $check_result = mysqli_query($conn, $check_query);

        if (mysqli_num_rows($check_result) > 0) {
            echo "Username already exists. Please choose a different username.";
        } 
        else {

          $insert_user_query = "INSERT INTO users (username, password) VALUES ('$username', '$password')";

        if (mysqli_query($conn, $insert_user_query)) {
            echo "Account created successfully!";
        } else {
            echo "Error creating account: " . mysqli_error($conn);
        }
            // If the username is unique, create a new table for the user
            $table_name = "user_" . $username;

            $create_table_query = "CREATE TABLE IF NOT EXISTS $table_name (
                year VARCHAR(255),
                month VARCHAR(255),
                date VARCHAR(255),
                day VARCHAR(255),
                time VARCHAR(255),
                place VARCHAR(255),
                bgname VARCHAR(255),
                bgfname VARCHAR(255),
               bgaddress TEXT,
               bname VARCHAR(255),
                bfname VARCHAR(255),
                baddress TEXT,
                wname VARCHAR(255),
                waddress VARCHAR(255),
                wwname VARCHAR(255),
                wwadress VARCHAR(255),
                upload VARCHAR(255),
                number INT
            )";

            if (mysqli_query($conn, $create_table_query)) {
                echo "Table created successfully!";
            } else {
                echo "Error creating table: " . mysqli_error($conn);
            }
            
          header("Location: index.php"); // Redirect to home.php after successful login
    exit();
        }
    }

    // PHP code for sign-in
    if (isset($_POST['signin'])) {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "form";

        $conn = mysqli_connect($servername, $username, $password, $database);

        if (!$conn) {
            die("Sorry we failed to connect: " . mysqli_connect_error());
        }

        $login_username = mysqli_real_escape_string($conn, $_POST['login_username']);
        $login_password = mysqli_real_escape_string($conn, $_POST['login_password']);

        // Verify the login credentials
        $login_query = "SELECT * FROM users WHERE username = '$login_username' AND password = '$login_password'";
        $login_result = mysqli_query($conn, $login_query);

        if (mysqli_num_rows($login_result) > 0) {
            session_start();
            $_SESSION["username"] = $login_username;
            header("Location: home.php"); // Redirect to home.php after successful login
            exit();
        } else {
            echo "Invalid login credentials. Please try again.";
        }
    }
    ?>
</body>

</html>