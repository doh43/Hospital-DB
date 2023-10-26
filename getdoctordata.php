<?php
    $query = "SELECT * FROM doctor";
    // Check that the specialization is selected
    if (isset($_POST["spec"]) && $_POST["spec"] != "Any") {
        $query = $query . " WHERE doctor.speciality = " .  "'" . $_POST["spec"] . "'";
    }
    // Check that the sorting field is selected 
    if (isset($_POST["orderby"]) && isset($_POST["sort"])) {
        $query = $query . " ORDER BY " . $_POST['orderby'] . " " . $_POST['sort'];
    } 
    
    $result = mysqli_query($conn, $query);
    if (!$result) {
        die("databases query failed.");
    }
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row["licensenum"] . "</td>";
        echo "<td>" . $row["firstname"] . "</td>" ;
        echo "<td>" . $row["lastname"] . "</td>";
        echo "<td>" . $row["licensedate"] . "</td>";
        echo "<td>" . $row["birthdate"] . "</td>";
        echo "<td>" . $row["hosworksat"] . "</td>";
        echo "<td>" . $row["speciality"] . "</td>";
        echo "</tr>";
    }
    mysqli_free_result($result);
?>