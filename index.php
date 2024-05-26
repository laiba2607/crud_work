<?php
include 'header.php';

// Establish connection to MySQL
$conn = mysqli_connect("localhost", "root", "", "crud") or die("Connection failed: " . mysqli_connect_error());

// Check if form is submitted for deleting a record
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
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

// Fetch records from the database
$sql = "SELECT * FROM student";
$result = mysqli_query($conn, $sql);

// Check if records exist
if (mysqli_num_rows($result) > 0) {
    echo "<div id='main-content'>";
    echo "<h2>All Records</h2>";
    echo "<table cellpadding='7px'>";
    echo "<thead>";
    echo "<th>Id</th>";
    echo "<th>Name</th>";
    echo "<th>Address</th>";
    echo "<th>Class</th>";
    echo "<th>Phone</th>";
    echo "<th>Action</th>";
    echo "</thead>";
    echo "<tbody>";

    // Output data of each row
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row["Id"] . "</td>";
        echo "<td>" . $row["Name"] . "</td>";
        echo "<td>" . $row["Address"] . "</td>";
        echo "<td>" . $row["Class"] . "</td>";
        echo "<td>" . $row["Phone"] . "</td>";
        echo "<td>";
        echo "<a href='edit.php?id=" . $row['Id'] . "' style=' text-decoration: none;'>Edit</a>";
   
        echo "<form method='post' style='display: inline;'>";
        echo "<input type='hidden' name='id' value='" . $row["Id"] . "' />";
        echo "<button type='submit' name='delete'style='text-decoration:none;background-color:red;color:white;font-weight:bold;font-size:medium;margin-left:5px;'>Delete</button>";
        echo "</form>";
        echo "</td>";
        echo "</tr>";
    }

    echo "</tbody>";
    echo "</table>";
    echo "</div>";
} else {
    echo "0 results";
}

// Close connection
mysqli_close($conn);
?>

<style>
    body {
        background-color: #252A34;
    }

    #header {
        background-color: #0D7377;
    }

    #header h1 {
        color: #FF2E63;
    }

    /*#menu {
        background-color: #252A34;
    }

    #menu ul li a {
        color: #E84545;
    }

    #menu ul li a:hover {
        background-color: #252A34;
    }*/

    #main-content table {
        background-color: #252A34;
        border: 5px solid #0D7377;
    }

    #main-content table th {
        color: #E84545;
        background-color: #252A34;
    }

    #main-content table td {
        background-color: #252A34;
        border: 1px solid #FF2E63;
        color: #08D9D6;
    }

  
</style>

    <table cellpadding="7px">
   
          
<?php
while($row = mysqli_fetch_assoc($result)){
?>
<tr>
<td><?php echo $row['Id']; ?></td>
 <td><?php echo $row['Name']; ?></td>
  <td><?php echo $row["Address"]; ?></td> 
  <td><?php echo $row['Class']; ?></td>
   <td><?php echo $row['Phone']; ?></td> 
   <td>
    <a href='edit.php?id=<?php echo $row['Id']; ?>'class="btn btn-danger">Edit</a>
    <a href='delete.php?id=<?php echo $row['Id']; ?>'>Delete</a>
</td>
</tr>
<?php
}
?>
        </tbody>
    </table>




</div>
</div>
</body>
</html>