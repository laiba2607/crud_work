<?php
include 'header.php';


$conn = mysqli_connect("localhost", "root", "", "crud") or die("Connection failed: " . mysqli_connect_error());


$sql_alter = "ALTER TABLE student MODIFY COLUMN Id INT AUTO_INCREMENT";
if (mysqli_query($conn, $sql_alter)) {
    
} else {
    echo "ERROR: Could not able to execute $sql_alter. " . mysqli_error($conn);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])) {
   
    if (isset($_POST['Name'], $_POST['Address'], $_POST['Class'], $_POST['Phone'])) {
       
        $Name = mysqli_real_escape_string($conn, $_POST['Name']);
        $Address = mysqli_real_escape_string($conn, $_POST['Address']);
        $Class = mysqli_real_escape_string($conn, $_POST['Class']);
        $Phone = mysqli_real_escape_string($conn, $_POST['Phone']);

       
        $sql = "INSERT INTO student (Name, Address, Class, Phone) VALUES ('$Name', '$Address', '$Class', '$Phone')";
        if (mysqli_query($conn, $sql)) {
            echo "Records added successfully.";
        } else {
            if (mysqli_errno($conn) == 1062) {
                echo "Error: Duplicate entry detected.";
            } else {
                echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
            }
        }
    } else {
        echo "ERROR: Form fields are not set.";
    }
}


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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Record</title>
   
</head>
<body>
<div id="main-content">
    <h2>Add New Record</h2>
    <form class="post-form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <div class="form-group">
            <label>Name</label>
            <input type="text" name="Name" />
        </div>
        <div class="form-group">
            <label>Address</label>
            <input type="text" name="Address" />
        </div>
        <div class="form-group">
            <label>Class</label>
            <select name="Class">
                <option value="" selected disabled>Select Class</option>
                <option value="Eight">Eight</option>
                <option value="Nine">Nine</option>
                <option value="Matric">Matric</option>
            </select>
        </div>
        <div class="form-group">
            <label>Phone</label>
            <input type="text" name="Phone" />
        </div>
        <input type="submit" name="add" value="Add" class="submit" />
   
    </form>
</div>
</body>
</html>