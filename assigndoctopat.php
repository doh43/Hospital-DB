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
<div id="doctopat">
    <h1>Assign Doctor to Patient</h1>
    <form action="assignDocToPat.php" method="POST">
        <h3>Doctor</h3>
        <!-- fetch all doctors -->
        <select name="doctor">
            <?php
                $query = "SELECT * FROM doctor";
                $result = mysqli_query($conn, $query);
                if (!$result) {
                    die("databases query failed.");
                }
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value=" . $row["licensenum"] . ">" . $row["firstname"] . " " . $row["lastname"] . "</option>";
                }
                mysqli_free_result($result);
            ?>
        </select>
        <h3>Patient</h3>
        <!-- fetch all patients -->
        <select name="patient">
            <?php
                $query = "SELECT * FROM patient";
                $result = mysqli_query($conn, $query);
                if (!$result) {
                    die("databases query failed.");
                }
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value=" . $row["ohipnum"] . ">" . $row["firstname"] . " " . $row["lastname"] . "</option>";
                }
                mysqli_free_result($result);
            ?>
        </select>
        <br><button style="width: 100px;" type="submit">Assign</button>
    </form>
    <!-- handle form submission -->
    <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $query = "SELECT * FROM looksafter WHERE looksafter.licensenum = '" . $_POST["doctor"] . "' AND looksafter.ohipnum = " . $_POST["patient"];
            $result = mysqli_query($conn, $query);
            if (!$result) {
                die("databases query failed.");
            }
            if (mysqli_num_rows($result) == 0)  {
                $query = "INSERT INTO looksafter (licensenum, ohipnum) VALUES ('" . $_POST["doctor"] . "'," . $_POST["patient"] . ")";
                $result = mysqli_query($conn, $query);
                if (!$result) {
                    die("databases query failed.");
                }
                echo "<p>Doctor successfully assigned to patient</p>";
            } else {
                echo "<p>Error: patient already assigned to doctor</p>";
                mysqli_free_result($result); 
            }
        }
        
    ?>
</div>
    
</body>
</html>