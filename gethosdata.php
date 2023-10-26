<?php
    if (isset($_POST["hoscode"])) {
        // Get all doctors that work at the selected hospital
        $query = "SELECT * FROM hospital WHERE hoscode = '" . $_POST["hoscode"] . "'";
        $result = mysqli_query($conn, $query);
        if (!$result) {
            die("databases query failed.");
        }

        echo "<h3>Hospital</h3>";
        echo "<table>
        <tr>
            <th>Name</th>
            <th>City</th>
            <th>Province</th>
            <th>Number of beds</th>
        </tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row["hosname"] . "</td>";
            echo "<td>" . $row["city"] . "</td>" ;
            echo "<td>" . $row["prov"] . "</td>";
            echo "<td>" . $row["numofbed"] . "</td>";
            echo "</tr>";
        }
        mysqli_free_result($result);
        echo "</table><br>";

        echo "<h3>Head Doctor</h3>";
        echo "<table>
        <tr>
            <th>Head Doc first name</th>
            <th>Head Doc last name</th>
        </tr>";
        // Get all of the head doctors at the selected hospital
        $query = "SELECT * FROM hospital, doctor WHERE hoscode = '" . $_POST["hoscode"] . "' AND hospital.headdoc = doctor.licensenum";
        $result = mysqli_query($conn, $query);
        if (!$result) {
            die("databases query failed.");
        }
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row["firstname"] . "</td>";
            echo "<td>" . $row["lastname"] . "</td>" ;
            echo "</tr>";
        }
        mysqli_free_result($result);
        echo "</table><br>";

        echo "<h3>Doctors</h3>";
        echo "<table>
        <tr>
            <th>Doctor first name</th>
            <th>Doctor last name</th>
        </tr>";
        $query = "SELECT * FROM doctor, hospital WHERE hoscode = '" . $_POST["hoscode"] . "' AND doctor.hosworksat = hospital.hoscode";
        $result = mysqli_query($conn, $query);
        if (!$result) {
            die("databases query failed.");
        }
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row["firstname"] . "</td>";
            echo "<td>" . $row["lastname"] . "</td>" ;
            echo "</tr>";
        }
        mysqli_free_result($result);
        echo "</table><br>";

    }
    
?>