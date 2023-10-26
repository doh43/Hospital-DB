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
    <h1>Patient Info by Doctor</h1>
    <form action="docpatinfo.php" method="POST">
        <select name="doctor">
            <option value="">select doctor</option>
            <!-- fetch all doctors -->
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
        <br><button style="width: 100px;" type="submit">Find patients</button>
    </form>
    <!-- table of patient information for the selected doctor -->
    <table>
        <tr>
            <th>First name</th>
            <th>Last name</th>
            <th>OHIP Number</th>
        </tr>
        <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $query = "SELECT patient.lastname, patient.firstname, patient.ohipnum FROM 
                            patient, looksafter WHERE looksafter.licensenum = '" . $_POST["doctor"] . "' AND 
                            patient.ohipnum = looksafter.ohipnum";
                $result = mysqli_query($conn, $query);
                if (!$result) {
                    die("databases query failed.");
                }
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row["firstname"] . "</td>" ;
                    echo "<td>" . $row["lastname"] . "</td>";
                    echo "<td>" . $row["ohipnum"] . "</td>";
                    echo "</tr>";
                }
            }
        ?>
    </table>
    
</div>
</body>
</html>