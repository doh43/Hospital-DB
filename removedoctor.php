<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./css/styles.css">
    <title>Hospital Info</title>
</head>
<body>
<?php
    include 'connectdb.php';
?>
<a id="back" href="index.php" style="position: fixed; left: 20px; top: 20px;"><button>Back</button></a>
<div id="removedoctor">
    <h1>Remove Doctor</h1>
    <form action="removedoctor.php" method="POST" onsubmit="return confirm('The doctor will be permanently removed. Are you sure?');">
        <?php
            $query = "SELECT * from doctor";
            $result = mysqli_query($conn, $query);
            if (!$result) {
                die("databases query failed.");
            }
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<input type='radio' name='doctor' value=" . $row["licensenum"] . " id = " . $row["licensenum"] . ">";
                echo "<label for=" . $row["licensenum"] . ">" . $row["firstname"] . " " . $row["lastname"] . "</label><br>";
            }
        ?>
        <button type="submit">Remove</button>
    </form> 
    <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if (!isset($_POST["doctor"])) {
                    echo "<p>Error: doctor not selected</p>";
                } else {
                    $query = "SELECT * FROM doctor, looksafter WHERE doctor.licensenum = looksafter.licensenum AND doctor.licensenum = '" . $_POST["doctor"] . "'"; 
                    $result = mysqli_query($conn, $query);
                    if (mysqli_num_rows($result) > 0) {
                        echo "<p>Could not remove doctor (either doctor has patients or is a head doctor)</p>";
                        mysqli_free_result($result);
                        die();
                    } else {
                        $query = "DELETE FROM doctor WHERE doctor.licensenum = '" . $_POST["doctor"] . "'";
                        $result = mysqli_query($conn, $query);
                        if (!$result) {
                            die("database query failed.");
                        } 
                    }
                    // Redirect back to the page to show the updated list
                    header("location:removedoctor.php");
                }
            }
    ?>
</div>
    
</body>
</html>