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
<div id="adddoctor">
    <h1>Add Doctor</h1>
    <form action="adddoctor.php" method="POST">
        <label for="licensenum">License Number</label>
        <input type="text" id="licensenum" name="licensenum" required><br>
        <label for="firstname">First name</label>
        <input type="text" id="firstname" name="firstname" required><br>
        <label for="lastname">Last name</label>
        <input type="text" id="lastname" name="lastname" required><br>
        <label for="licensedate">License date</label>
        <input type="date" id="licensedate" name="licensedate" required><br>
        <label for="bdate">Birthdate</label>
        <input type="date" id="bdate" name="bdate" required><br>
        <label for="hoscode">Hospital</label>
        <!-- get all existing hospitals -->
        <input type="hoscode" id="hoscode" name="hoscode" list="hospitals" required><br> 
        <datalist id="hospitals">
            <?php
                $query = "SELECT hoscode from hospital";
                $result = mysqli_query($conn, $query);
                if (!$result) {
                    die("databases query failed.");
                }
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value=" . $row["hoscode"] . ">" . $row["hoscode"] . "</option>";
                }
                mysqli_free_result($result);
            ?>
        </datalist>
        <label for="spec">Speciality</label>
        <input type="text" id="spec" name="spec" required><br>
        <button style="width: 100px;" type="submit">Add</button>
    </form>
    <?php
        include 'createDoctor.php';
    ?>
</div>
    
</body>
</html>