

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="form.css">
    <style>
        .fill_form
        {
            border: 2px solid black;
           display: flex;
           width: 40%;
           margin-bottom: 20px;
            box-shadow: 2px 2px 22px 2px rgb(0, 0, 0);
        }
        body{
            width: 100%;
            align-items: center;
            
        }
        nav .logo
        {
            padding-top: 10px;
            margin-top: 5px;
        }
      
  .material-symbols-outlined
       {
        font-variation-settings:
        'FILL' 0,
        'wght' 400,
        'GRAD' 0,
        'opsz' 24
        }
    </style>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>
<body>
<!-- navigation -->
<nav>
    <div class="nav-content">
      <div class="logo">
        <a href="Entries.php"><span class="material-symbols-outlined"></span>Back</a>
      </div>
  </nav>


<h1 style="margin-top: 70px; text-align:center;">FILL THE DATA</h1>
<!-- form design -->
<div class="fill_form">
<form class="f1" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"> 

<div class="year" ><label for="">YEAR:</label><br>
  <input type="text" name="year" required>
</div>

<div class="month"><label for="">MONTH:</label><br>
  <input type="text" name="month" required>
</div>

  <div class="date"><label for="">DATE:</label><br>
  <input type="text" name="date" required>
</div>

 <div class="day"><label for="">DAY:</label><br>
  <input type="text" name="day" required>
</div>

 <div class="time"><label for="">TIME:</label><br>
  <input type="text" name="time" required>
</div>

 <div class="place"><label for="">PLACE:</label><br>
  <input type="text" name="place">
</div>

<div class="bride_details">
<h4 class="h41">
 <u> DETAILS OF BRIDEGROOM:</u> 
</h4>
<div class="bgname"><label for=""> NAME:</label><br>
  <input type="text" name="bgname">
</div>

<div class="bgfname"><label for="">FATHER'S NAME:</label><br>
  <input type="text" name="bgfname">
</div>

<div class="bgplace"><label for="">FULL ADDRESS:</label><br>
  <textarea rows="5" cols="70" name="bgaddress" placeholder="Enter text"></textarea>
</div>
</div>

<div class="bride_details">
<h4 class="h41">
  <u>DETAILS OF BRIDE: </u>
</h4>
<div class="bgname"><label for=""> NAME:</label><br>
  <input type="text" name="bname">
</div>

<div class="bgfname"><label for="">FATHER'S NAME:</label><br>
  <input type="text" name="bfname">
</div>

<div class="bgplace"><label for="">FULL ADDRESS:</label><br>
  <textarea rows="5" cols="70" name="baddress" placeholder="Enter text"></textarea>
</div>
</div>


<h4 class="h41">
  <u>WITNESS 1: </u>
</h4>
<div class="wname"><label for=""> NAME:</label><br>
  <input type="text" name="wname">
</div>

<div class="wplace"><label for="">ADDRESS:</label><br>
  <input type="text" name="waddress" >
</div>

<h4 class="h41">
  <u>WITNESS 2: </u>
</h4>
<div class="wname"><label for=""> NAME:</label><br>
  <input type="text" name="wwname">
</div>

<div class="wplace"><label for="">ADDRESS:</label><br>
  <input type="text" name="wwadress" >
</div>



<div class="upload_btn">
 <h4 class="h41">
  <u>NUMBER:</u>
</h4>
  <input type="text" name="number" >
  <h6>(number of anyone which acts as unique!!)</h6>


<h4 class="h41">
  <u>UPLOAD FILES: </u>
</h4>
  <input type="file" class="ubtn">
  <h6>(files like invitation,photos)</h6>
</div>



<input type="submit" value="Submit" class="ubtn">
</form>
</div>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "form"; // Your database name

// Create a connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check if the connection was successful
if (!$conn) {
    die("Sorry we failed to connect: " . mysqli_connect_error());
}


// Start the session (if not already started)
session_start();

// Check if the user is logged in
if (isset($_SESSION['username'])) {
    // Get the username from the session
    $loggedInUser = $_SESSION['username'];

    // Construct the user-specific table name
    $userTableName = "user_" . $loggedInUser;

    // Now you can use $userTableName in your code
} else {
    // Handle the case where the user is not logged in
    // For example, you can redirect them to the login page
    header("Location: login.php"); // Redirect to the login page
    exit();
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Fetch data from the form
    $year = $_POST['year'];
    $month = $_POST['month'];
    $date = $_POST['date'];
    $day = $_POST['day'];
    $time = $_POST['time'];
    $place = $_POST['place'];
    $bgname = $_POST['bgname'];
    $bgfname = $_POST['bgfname'];
    $bgaddress = $_POST['bgaddress'];
    $bname = $_POST['bname'];
    $bfname = $_POST['bfname'];
    $baddress = $_POST['baddress'];
    $wname = $_POST['wname'];
    $waddress=$_POST['waddress'];
    $wwname = $_POST['wwname'];
    $wwadress = $_POST['wwadress'];
    $number=$_POST['number'];

    // SQL query to insert data into the user-specific table
    $insert_query = "INSERT INTO $userTableName (year, month, date, day, time, place, bgname, bgfname, bgaddress, bname, bfname, baddress, wname, waddress, wwname, wwadress,number) VALUES ('$year', '$month', '$date', '$day', '$time', '$place', '$bgname', '$bgfname', '$bgaddress', '$bname', '$bfname', '$baddress', '$wname','$waddress', '$wwname', '$wwadress','$number')";

    if (mysqli_query($conn, $insert_query)) {
    echo '<div class="success-container">
        <p>Congratulations, you have successfully logged in!</p>
        <button id="close-button" class="close-button">x</button>
    </div>';
} else {
    echo "Error adding data: " . mysqli_error($conn);
}

}
?>


<!-- footer -->
  <footer class="footer">
  
    <ul class="social-icon">
        </a></li>
      <li class="social-icon__item"><a class="social-icon__link" href="#">
          <ion-icon name="logo-twitter"></ion-icon>
        </a></li>
      <li class="social-icon__item"><a class="social-icon__link" href="#">
          <ion-icon name="logo-instagram"></ion-icon>
        </a></li>
    </ul>
    <ul class="menu">
      <li class="menu__item"><a class="menu__link" href="index.html">Home</a></li>
      <li class="menu__item"><a class="menu__link" href="about.html">About</a></li>
      <li class="menu__item"><a class="menu__link" href="Entries.html">Entries</a></li>
      <li class="menu__item"><a class="menu__link" href="contact.html">Contact</a></li>

    </ul>
    <p>&copy;2023 Registerly | All Rights Reserved</p>
  </footer>
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>
</html>