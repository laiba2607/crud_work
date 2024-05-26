<?php
include 'header.php';

// Check if ID is set in the URL
if(isset($_GET['id'])) {
    $conn = mysqli_connect("localhost", "root", "", "crud") or die("connection failed");
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    // Fetch record based on ID
    $sql = "SELECT * FROM student WHERE Id = '$id'";
    $result = mysqli_query($conn, $sql) or die("query unsuccessful");

    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        // Retrieve data from the fetched record
        $id = $row['Id'];
        $name = $row['Name'];
        $address = $row['Address'];
        $class = $row['Class'];
        $phone = $row['Phone'];
    } else {
        echo "Record not found!";
    }

    mysqli_close($conn);
} else {
    echo "ID not provided!";
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve updated data from the form
    $id = $_POST['sid'];
    $name = $_POST['sname'];
    $address = $_POST['saddress'];
    $class = $_POST['sclass'];
    $phone = $_POST['sphone'];

    // Update record in the database
    $conn = mysqli_connect("localhost", "root", "", "crud") or die("connection failed");
    $sql = "UPDATE student SET Name='$name', Address='$address', Class='$class', Phone='$phone' WHERE Id='$id'";
    $result = mysqli_query($conn, $sql);

    // Check if the update was successful
    if ($result) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
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
</style>
<div id="main-content">
    <h2>Update Record</h2>
    <form class="post-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $id; ?>" method="post">
        <div class="form-group">
            <label>Name</label>
            <input type="hidden" name="sid" value="<?php echo $id; ?>"/>
            <input type="text" name="sname" value="<?php echo $name; ?>"/>
        </div>
        <div class="form-group">
            <label>Address</label>
            <input type="text" name="saddress" value="<?php echo $address; ?>"/>
        </div>
        <div class="form-group">
    <label>Class</label>
    <input type="text" name="sclass" value="<?php echo $class; ?>" readonly />
</div>
        <div class="form-group">
            <label>Phone</label>
            <input type="text" name="sphone" value="<?php echo $phone; ?>"/>
        </div>
        <input class="submit" type="submit" value="Update"/>
    </form>
</div>