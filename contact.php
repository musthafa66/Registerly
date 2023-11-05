<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="contact.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <style>

     .success-container {
    background: black;
    padding: 50px;
    border-radius: 15px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
    text-align: center;
    width: fit-content;
    position: relative; /* Required for positioning the close button */
    margin-left: 440px;
    margin-top: -340px;
    
   
}

p {
    margin: 0;
    font-size: 18px;
    color: white;
}

.close-button {
    position: absolute;
    top: 10px;
    right: 10px;
    background: none;
    border: none;
    cursor: pointer;
    font-size: 24px;
    color: #ccc;
}

.close-button:hover {
    color: #673232;
}
/* footer */

.footer {
  position: sticky;
  width: 100%;
  background: #000000;
  min-height: 100px;
  padding: 20px 50px;
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
  margin-top: auto;
  
}

.social-icon,
.menu {
  position: relative;
  display: flex;
  justify-content: center;
  align-items: center;
  margin: 10px 0;
  flex-wrap: wrap;
}

.social-icon__item,
.menu__item {
  list-style: none;
}

.social-icon__link {
  font-size: 2rem;
  color: #fff;
  margin: 0 10px;
  display: inline-block;
  transition: 0.5s;
}
.social-icon__link:hover {
  transform: translateY(-10px);
}

.menu__link {
  font-size: 1.2rem;
  color: #fff;
  margin: 0 10px;
  display: inline-block;
  transition: 0.5s;
  text-decoration: none;
  opacity: 0.75;
  font-weight: 300;
}

.menu__link:hover {
  opacity: 1;
}

.footer p {
  color: #fff;
  margin: 15px 0 10px 0;
  font-size: 1rem;
  font-weight: 300;
}
nav .nav-content{
  margin-top: 15px;
}
  .material-symbols-outlined {
          margin-right: -59px;
        margin-left: 30px;
       font-variation-settings:
        'FILL' 0,
        'wght' 400,
      'GRAD' 0,
      'opsz' 24
      }
    </style>
</head>

<body>
    <nav>
      
        
        <div class="nav-content">
          <div class="logo">
            <a href="#">Registerly</a>
          </div>
          <ul class="nav-links">
            <li><a href="home.php">Home</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="Entries.php">Entries</a></li>
            <li><a href="contact.php">Contact</a></li>
            <li><a href="index.php"><span class="material-symbols-outlined">
logout
</span></a></ul>
        </div>

    </nav>
    <div class="background">
        <div class="container">
            <div class="screen">
                <div class="screen-header">
                    <div class="screen-header-left">
                        <div class="screen-header-button close"></div>
                <div class="screen-header-button maximize"></div>
                <div class="screen-header-button minimize"></div>
                    </div>
                </div>
                <div class="screen-body">
                    <div class="screen-body-item left">
                        <div class="app-title">
                            <span>CONTACT</span>
                            <span>US</span>
                        </div>
                        <div class="app-contact">CONTACT INFO</div>
                    </div>
                    <div class="screen-body-item">
                        <div class="app-form">
                            <form method="POST" action="contact.php">
                                <div class="app-form-group">
                                    <input class="app-form-control" placeholder="NAME" name="name">
                                </div>
                                <div class="app-form-group">
                                    <input class="app-form-control" placeholder="EMAIL" name="email">
                                </div>
                                <div class="app-form-group">
                                    <input class="app-form-control" placeholder="CONTACT NO" name="contactNo">
                                </div>
                                <div class="app-form-group message">
                                    <input class="app-form-control" placeholder="MESSAGE" name="message">
                                </div>
                                <div class="app-form-group buttons">
                                    <button class="app-form-button" value="CANCEL">CANCEL</button>
                                    <button class="app-form-button" type="submit">SEND</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
      <li class="menu__item"><a class="menu__link" href="home.php">Home</a></li>
      <li class="menu__item"><a class="menu__link" href="about.php">About</a></li>
      <li class="menu__item"><a class="menu__link" href="Entries.php">Entries</a></li>
      <li class="menu__item"><a class="menu__link" href="contact.php">Contact</a></li>
       <li class="menu__item"><a class="menu__link" href="index.php">Logout</a></li>

    </ul>
    <p>&copy;2023 Registerly | All Rights Reserved</p>
  </footer>
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "form";

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $contactNo = $_POST['contactNo'] ?? '';
    $message = $_POST['message'] ?? '';

    $sql = "INSERT INTO contact_info (name, email, contact_number, message)
    VALUES ('$name', '$email', '$contactNo', '$message')";

    if ($conn->query($sql) === TRUE) {
    $successMessage = '<div class="success-container" id="successMessage">
        <p>Thank you for reaching out. We will be in touch soon!</p>
        <button id="close-button" class="close-button">x</button>
    </div>';
    echo $successMessage;
}
 else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const successMessage = document.getElementById("successMessage");

        if (successMessage) {
            setTimeout(function() {
                successMessage.style.display = "none";
            }, 5000); // Hide the message after 5 seconds
        }

        // Close message when the 'x' button is clicked
        const closeButton = document.getElementById("close-button");
        if (closeButton) {
            closeButton.addEventListener("click", function() {
                successMessage.style.display = "none";
            });
        }
    });
</script>


</html>




