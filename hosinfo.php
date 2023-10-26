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
<div id="doctorsinfo">
    <h1>Hospitals Information</h1>
    <form action="hosinfo.php" method="POST">
        <select name="hoscode" id="hoscode">
            <option value="">Select a hospital</option>
            <?php
                // Use a dropdown with existing hospitals
                $query = "SELECT * FROM hospital";
                $result = mysqli_query($conn, $query);
                if (!$result) {
                    die("databases query failed.");
                }
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value=" . $row["hoscode"] . ">" . $row["hosname"] . " (" . $row["prov"] . ")" . "</option>";
                }
                mysqli_free_result($result);
            ?>
        </select>
        <button type="submit">find</button>
    </form>
    <?php
            include 'gethosdata.php';
    ?>
</div>
    
</body>
</html>