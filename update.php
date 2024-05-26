<?php
include 'header.php';

// Establish connection to MySQL
$conn = mysqli_connect("localhost", "root", "", "crud") or die("Connection failed: " . mysqli_connect_error());

// Initialize variables
$sid = $sname = $saddress = $sclass = $sphone = "";

// Check if form is submitted to show record
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['showbtn'])) {
    // Check if 'sid' is set
    if (isset($_POST['sid'])) {
        // Escape 'sid' input for security
        $sid = mysqli_real_escape_string($conn, $_POST['sid']);

        // Fetch record from database
        $sql = "SELECT * FROM student WHERE Id='$sid'";
        $result = mysqli_query($conn, $sql);
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            // Set fetched data to variables
            $sname = $row['Name'];
            $saddress = $row['Address'];
            $sclass = $row['Class'];
            $sphone = $row['Phone'];
        } else {
            echo "No record found with ID: $sid";
        }
    } else {
        echo "ERROR: ID is not set.";
    }
}

// Check if form is submitted to update record
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    // Check if 'sid' is set
    if (isset($_POST['sid'])) {
        // Escape user inputs for security
        $sid = mysqli_real_escape_string($conn, $_POST['sid']);
        $sname = mysqli_real_escape_string($conn, $_POST['sname']);
        $saddress = mysqli_real_escape_string($conn, $_POST['saddress']);
        $sclass = mysqli_real_escape_string($conn, $_POST['sclass']);
        $sphone = mysqli_real_escape_string($conn, $_POST['sphone']);

        // Check if any field has changed
        $sql_check_changes = "SELECT * FROM student WHERE Id='$sid' AND (Name<>'$sname' OR Address<>'$saddress' OR Class<>'$sclass' OR Phone<>'$sphone')";
        $result_check_changes = mysqli_query($conn, $sql_check_changes);
        if ($result_check_changes && mysqli_num_rows($result_check_changes) > 0) {
            // Attempt update query execution
            $sql_update = "UPDATE stu SET Name='$sname', Address='$saddress', Class='$sclass', Phone='$sphone' WHERE Id='$sid'";
            if (mysqli_query($conn, $sql_update)) {
                echo "Record updated successfully.";
            } else {
                echo "ERROR: Could not able to execute $sql_update. " . mysqli_error($conn);
            }
        } else {
            echo "No changes made to update.";
        }
    } else {
        echo "ERROR: ID is not set.";
    }
}

// Close connection
mysqli_close($conn);
?>

    <style>

body{
  background-color: #252A34;
}
#header{
  background-color: #0D7377;
  
}
#header h1{
  color:#FF2E63;
}
/*#menu{
  background-color: #252A34;


}
#menu ul li a{
  color: #E84545;
}

#menu ul li a:hover{
  background-color:#252A34;
}*/
#main-content table{
  
  background-color: #252A34;
  border: 5px solid #0D7377;
  
}
#main-content table th{
  color: #E84545;
  background-color: #252A34;

  
  
}
#main-content table td{
  background-color: #252A34;
  border: 1px solid #FF2E63;
  color: #08D9D6;
}

</style>
</style>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Record</title>
    <style>
        /* Your CSS styles here */
    </style>
</head>
<body>
<div id="main-content">
    <h2>Edit Record</h2>
    <form class="post-form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <div class="form-group">
            <label>Id</label>
            <input type="text" name="sid" value="<?php echo $sid; ?>" />
        </div>
        <input class="submit" type="submit" name="showbtn" value="Show" />
    </form>

    <form class="post-form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <input type="hidden" name="sid" value="<?php echo $sid; ?>" /> <!-- Retain 'sid' value -->
        <div class="form-group">
            <label for="sname">Name</label>
            <input type="text" name="sname" value="<?php echo $sname; ?>" />
        </div>
        <div class="form-group">
            <label>Address</label>
            <input type="text" name="saddress" value="<?php echo $saddress; ?>" />
        </div>
        <div class="form-group">
            <label>Class</label>
            <input type="text" name="sclass" value="<?php echo $sclass; ?>" />
        </div>
        <div class="form-group">
            <label>Phone</label>
            <input type="text" name="sphone" value="<?php echo $sphone; ?>" />
        </div>
        <input class="submit" type="submit" name="update" value="Update" />
    </form>
</div>
</body>
</html>