<?php include 'header.php'; 

// Establish connection to MySQL
$conn = mysqli_connect("localhost", "root", "", "crud") or die("Connection failed: " . mysqli_connect_error());

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if 'add' parameter is set, indicating an attempt to add a new record
    if (isset($_POST['add'])) {
        // Check if all form fields are set
        if (isset($_POST['Name'], $_POST['Address'], $_POST['Class'], $_POST['Phone'])) {
            // Escape user inputs for security
            $Name = mysqli_real_escape_string($conn, $_POST['Name']);
            $Address = mysqli_real_escape_string($conn, $_POST['Address']);
            $Class = mysqli_real_escape_string($conn, $_POST['Class']);
            $Phone = mysqli_real_escape_string($conn, $_POST['Phone']);

            // Attempt insert query execution
            $sql = "INSERT INTO student (Name, Adresss, Class, Phone) VALUES ('$Name', '$Address', '$Class', '$Phone')";
            if (mysqli_query($conn, $sql)) {
                echo "Record added successfully.";
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

    // Check if 'delete' parameter is set, indicating an attempt to delete a record
    if (isset($_POST['delete'])) {
        // Check if 'id' is set
        if (isset($_POST['id'])) {
            // Escape 'id' input for security
            $id = mysqli_real_escape_string($conn, $_POST['id']);

            // Attempt delete query execution
            $sql = "DELETE FROM student WHERE id='$id'";
            if (mysqli_query($conn, $sql)) {
                echo "Record deleted successfully.";
            } else {
                echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
            }
        } else {
            echo "ERROR: ID is not set.";
        }
    }
}

// Close connection
mysqli_close($conn);
?>

<style>body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        #main-content {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            color: #666;
        }
        input[type="text"] {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            border: none;
            padding: 12px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        input[type="submit"]:hover {
            background-color: #45a049;

        }
       

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
}
#main-content table{
    
    background-color: #252A34;
    border: 5px solid #0D7377;
    
}
#main-content table th{
    color: #E84545;
    background-color: #252A34;

    
    
}*/
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
    <title>Delete Record</title>

</head>
<body>
<div id="main-content">
    <h2>Delete Record</h2>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <div class="form-group">
            <label for="id">Enter ID to delete:</label>
            <input type="text" id="id" name="id">
        </div>
        <input type="submit" name="delete" value="Delete">
    </form>
</div>
</body>
</html>