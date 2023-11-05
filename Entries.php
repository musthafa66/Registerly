<?php

session_start();

$servername = "localhost";
$username = "root";
$password = "";
$database = "form";

if (!isset($_SESSION['username'])) {
    // Redirect to the login page
    header("Location: index.php");
    exit();
}
// Connection to the database
$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Sorry, we failed to connect: " . mysqli_connect_error());
}

$loggedInUser = $_SESSION['username'];
$userTableName = "user_" . $loggedInUser;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['logout'])) {
    // Log out the user
    $_SESSION = array(); // Clear all session variables
    session_destroy(); // Destroy the session
    header("Location: index.php"); // Redirect to the signup page after logging out
    exit();
}

$dataCount = 0; // Default to no data      
if (mysqli_query($conn, "SELECT 1 FROM $userTableName")) {
    $checkDataQuery = "SELECT COUNT(*) as count FROM $userTableName";
    $result = mysqli_query($conn, $checkDataQuery);
    $dataCount = mysqli_fetch_assoc($result)['count'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <meta http-equiv="cache-control" content="no-store, no-cache, must-revalidate, post-check=0, pre-check=0">
<meta http-equiv="cache-control" content="post-check=0, pre-check=0">
<meta http-equiv="expires" content="0">
<meta http-equiv="pragma" content="no-cache">

    <link rel="stylesheet" href="entries.css">
    <link rel="stylesheet" href="table.css">
     <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <style>
        .table-wrapper{
    margin: 10px 70px 70px;
    box-shadow: 0px 35px 50px rgba( 0, 0, 0, 0.2 );
    width: max-content;
    height: max-content;
    
}

 .material-symbols-outlined
  {
        margin-right: -59px;
        margin-left: 30px;
        font-variation-settings:
        'FILL' 0,
        'wght' 400,
        'GRAD' 0,
        'opsz' 24
 }

  nav .nav-content
  {
  margin-top: 15px;
}

nav .nav-links
{
  margin-top: 15px;
}

@media (max-width: 767px) {
    .fl-table {
        display: block;
        width: 100%;
    }
    .table-wrapper:before{
        content: "Scroll horizontally >";
        display: block;
        text-align: right;
        font-size: 11px;
        color: white;
        padding: 0 0 10px;
    }
    .fl-table thead, .fl-table tbody, .fl-table thead th {
        display: block;
    }
    .fl-table thead th:last-child{
        border-bottom: none;
    }
    .fl-table thead {
        float: left;
    }
    .fl-table tbody {
        width: auto;
        position: relative;
        overflow-x: auto;
    }
    .fl-table td, .fl-table th {
        padding: 20px .625em .625em .625em;
        height: 60px;
        vertical-align: middle;
        box-sizing: border-box;
        overflow-x: hidden;
        overflow-y: auto;
        width: 120px;
        font-size: 13px;
        text-overflow: ellipsis;
    }
    .fl-table thead th {
        text-align: left;
        border-bottom: 1px solid #f7f7f9;
    }
    .fl-table tbody tr {
        display: table-cell;
    }
    .fl-table tbody tr:nth-child(odd) {
        background: none;
    }
    .fl-table tr:nth-child(even) {
        background: transparent;
    }
    .fl-table tr td:nth-child(odd) {
        background: #F8F8F8;
        border-right: 1px solid #E6E4E4;
    }
    .fl-table tr td:nth-child(even) {
        border-right: 1px solid #E6E4E4;
    }
    .fl-table tbody td {
        display: block;
        text-align: center;
    }
}

.fl-table {
    border-radius: 5px;
    font-size: 12px;
    font-weight: normal;
    border: none;
    border-collapse: collapse;
    width: max-content;
    
    white-space: nowrap;
    background-color: white;
    
}

.fl-table td, .fl-table th {
    text-align: center;
    padding: 8px;
    
}

.fl-table td {
    border-right: 1px solid #f8f8f8;
    font-size: 12px;

}
.btnl{
    background-color: black;
    color: #F8F8F8;
    font-family: "Ubuntu", sans-serif;
    border: 0px;
    font-size: 18px;
    font-weight:bolder;
}

.btnl:hover{
    color:#616161;
}
.fl-table thead th {
    color: #ffffff;
    background: #000000;
    
}


.fl-table thead th:nth-child(odd) {
    color: #ffffff;
    background: #000000;
}

.fl-table tr:nth-child(even) {
    background: #F8F8F8;
}
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
.h1tabel{
    text-align: center;

    font-family:monospace; 
    border:2px solid green;
     font-size:50px;
     color: black;
}

.h1tabel:hover
{
    border: black solid 3px;
    color: green;
}
    </style>
</head>

<body>

   
    <nav>
        <div class="nav-content">
          <div class="logo">
            <a href="#">Registerly </a>
          </div>
          <ul class="nav-links">
            <li><a href="home.php">Home</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="Entries.php">Entries</a></li>
            <li><a href="contact.php">Contact</a></li>
            <li>
                <!-- Log-out form -->
                <form method="POST">
                    <button type="submit" name="logout" class="btnl">logout</button>
                </form>
            </li>
          </ul>
        </div>
      </nav><br><br><br><br>


   <!-- search bar -->
   
    <form class="d-flex" method="POST" action='<?php echo $_SERVER['PHP_SELF']; ?>'>
        <input class="srch_bar" type="text" name="search" placeholder="Search" aria-label="Search">
        <input type="submit" name="submit_serch" value="search">
    </form>

    <div class="table-wrapper">
        <h1 class="h1tabel">YOUR DATA</h1>

        <table class="fl-table" id="myTable" style="width: max-content;">
            <thead>
                <!-- Your table header -->
                 <tr>
                <th>YEAR</th>
                <th>MONTH</th>
                <th>DATE</th>
                <th>DAY</th>
                <th>TIME</th>
                <th>PLACE</th>
                <th>BRIDEGROOM NAME</th>
                <th>FATHER'S NAME</th>
                <th>ADDRESS</th>
                <th>BRIDE NAME</th>
                <th>FATHER'S NAME</th>
                <th>ADDRESS</th>
                <th>WITNESS1 NAME</th>
                <th>ADDRESS</th>
                <th>WITNESS2 NAME</th>
                <th>ADDRESS</th>
                <th>UPLOAD</th>
                <th>NUMBER</th>
                <th>DELETE</th>
                <th>UPDATE</th>
                <th>VIEW</th>
            </tr>
            </thead>
            <tbody>
                <?php
                if ($dataCount > 0) {
                    $sql = "SELECT * FROM $userTableName";
                    $result = mysqli_query($conn, $sql);

                    while ($row = mysqli_fetch_assoc($result)) {
                        // Display the user's data
                        ?>
                        <tr>
                            <!-- Output your table rows here -->
                            <!-- Example: -->
                           <td><?php echo $row['year']; ?></td>
        <td><?php echo $row['month']; ?></td>
        <td><?php echo $row['date']; ?></td>
        <td><?php echo $row['day']; ?></td>
        <td><?php echo $row['time']; ?></td>
        <td><?php echo $row['place']; ?></td>
        <td><?php echo $row['bgname']; ?></td>
        <td><?php echo $row['bgfname']; ?></td>
        <td><?php echo $row['bgaddress']; ?></td>
        <td><?php echo $row['bname']; ?></td>
        <td><?php echo $row['bfname']; ?></td>
        <td><?php echo $row['baddress']; ?></td>
        <td><?php echo $row['wname']; ?></td>
        <td><?php echo $row['waddress']; ?></td>
        <td><?php echo $row['wwname']; ?></td>
        <td><?php echo $row['wwadress']; ?></td>
        <td><?php echo $row['upload']; ?></td>
        <td><?php echo $row['number']; ?></td>
        <td>
            <form method='post' action='<?php echo $_SERVER['PHP_SELF']; ?>'>
                <input type='hidden' name='delete_year' value='<?php echo $row['year']; ?>'>
                <input type='submit' name='delete' value='Delete'>
            </form>
        </td>
        <td> <form method='post' action='<?php echo $_SERVER['PHP_SELF']; ?>'>
        <input type='hidden' name='edit_id' value='<?php echo $row['year']; ?>'>
        <input type='submit' name='edit' value='Edit'>
    </form>
        </td>
                        </tr>
                        <?php
                    }
                } else {
                    // Display a message if there's no data
                    ?>
                    <tr>
                        <td colspan="20">No data available</td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Add/Logout buttons -->
    <div class="buttons">
        <button class="b1" onclick="location.href='form.php'">ADD</button>
    </div>

    



<!-- deleting code -->
<?php



if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
 
   
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {

 if (isset($_POST['delete'])) 
     {
        // Delete functionality logic
        $deleteYear = $_POST['delete_year']; 

        
        // Construct your SQL query to delete the record based on the year
        $deleteQuery = "DELETE FROM $userTableName WHERE year = '$deleteYear'";

        // Execute the delete query
        $result = mysqli_query($conn, $deleteQuery);

        if ($result) {
            //reload the page
        echo '<script type="text/javascript">window.location.href = window.location.href;</script>';
        // Deletion was successful
    
        exit; 
        } 
    else 
    {
        // Handle any errors here
        echo "Error: " . mysqli_error($conn);
    }
    }





    if (isset($_POST['edit'])) {
        $editYear = $_POST['edit_id'];
        
        // Fetch the record to be edited based on the ID
        $editQuery = "SELECT * FROM $userTableName WHERE year = '$editYear'";
        $editResult = mysqli_query($conn, $editQuery);

        if ($editResult) {
            $editRow = mysqli_fetch_assoc($editResult);
            // Here, you can use the data in $editRow to pre-fill an edit form for the user to make changes
            // For example:
            $editYear = $editRow['year'];
            $editMonth = $editRow['month'];
            // Fetch other columns similarly

            // Create an edit form with fields pre-filled with the existing record data
            // Allow the user to update the data and submit the form to save changes

            // Example of an edit form for year and month (repeat for other fields)
            ?>
          <!-- Display the edit form -->
            <form method="POST" action="Entries.php" id="editForm">
    <input type="hidden" name="edit_record_id" value="<?php echo $editRow['year']; ?>">
    <input type="text" name="edited_year" value="<?php echo $editRow['year']; ?>">
    <input type="text" name="edited_month" value="<?php echo $editRow['year']; ?>">
    <!-- Other input fields to edit other columns pre-filled with their respective $editRow values -->
    <input type="submit" name="save_changes" value="Save Changes" onclick="closeEditForm()">
</form>

                                                                                                                                                                                                                                
            <?php
        } else {
            echo "Error fetching the record for editing: " . mysqli_error($conn);
        }
    }

    // Handling the submission of edited data and updating the database
    if (isset($_POST['save_changes'])) {
    $editedYear = $_POST['edited_year'];
    $editedMonth = $_POST['edited_month'];
    // Get other edited fields similarly

    $editRecordId = $_POST['edit_record_id'];

    // Perform an SQL query to update the record in the database
    $updateQuery = "UPDATE $userTableName SET year = '$editedYear', month = '$editedMonth' WHERE year = '$editedYear'";
    $updateResult = mysqli_query($conn, $updateQuery);

    if ($updateResult) {
        echo "Record updated successfully!";
        // Reload the page or redirect to display the updated records
        echo '<script type="text/javascript">window.location.href = window.location.href;</script>';
        exit;
    } else {
        echo "Error updating the record: " . mysqli_error($conn);
    }
}

}


?>


<script>
        //  to set footer width to match the table width
        window.onload = function() {
            const tableWidth = document.getElementById('myTable').offsetWidth;
            document.getElementById('myFooter').style.width = tableWidth + 'px';
        };
    </script>

<!-- Your footer section remains the same -->
    <!-- ... -->
    <!-- footer -->
      <footer class="footer" id="myFooter">
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

 <script>
    function closeEditForm() {
        document.getElementById('editForm').style.display = 'none';
    }
</script>


</body>
</html>
