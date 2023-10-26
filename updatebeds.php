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
<div id="updatebeds">
    <h1>Update Bed Number</h1>
    <form action="updatebeds.php" method="POST">
        <select name="hoscode">
            <?php
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
        <label for="bednum">Beds:</label>
        <!-- Should only accept numbers equal to or greater than 0 -->
        <input type="number" id="bednum" name="bednum" required min="0"><br>
        <br><button style="width: 100px;" type="submit">Update</button>
    </form>
    <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $query = "UPDATE hospital SET numofbed = " . $_POST["bednum"] . " WHERE hoscode = '" . $_POST["hoscode"] . "'";
            $result = mysqli_query($conn, $query);
            if (!$result) {
                die("databases query failed.");
            }
            echo "<p>Beds successfully updated</p>";
            
        }
        
    ?>
</div>
    
</body>
</html>