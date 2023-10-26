<?php

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        // check if the license number is unique 
        $query = "SELECT licensenum from doctor";
        $result = mysqli_query($conn, $query);
        if (!$result) {
            die("databases query failed.");
        }
        $licenses = array();
        while($row = mysqli_fetch_assoc($result)){
            array_push($licenses, $row["licensenum"]);
        }
        if (isset($_POST["licensenum"])) {
            if (in_array($_POST["licensenum"], $licenses)) {
                echo "<p>Error: license number already exists</p>";
                exit();
            } 
        }
        

        // check if the hospital the user is adding a doctor to exists
        $query = "SELECT hoscode from hospital";
        $result = mysqli_query($conn, $query);
        if (!$result) {
            die("databases query failed.");
        }
        $hoscodes = array();
        while($row = mysqli_fetch_assoc($result)){
            array_push($hoscodes, $row["hoscode"]);
        }
        if (isset($_POST["hoscode"])) {
            if (!in_array($_POST["hoscode"], $hoscodes)) {
                echo "<p>Error: hospital does not exist</p>";
                exit();
            } 
        }

        $licensenum = $_POST['licensenum'];
        $firstname = $_POST['firstname']; 
        $lastname = $_POST['lastname'];
        $licensedate = $_POST['licensedate'];
        $birthdate = $_POST['bdate'];
        $hosworksat = $_POST['hoscode'];
        $speciality = $_POST['spec'];

        // create the new doctor
        $query = "INSERT INTO doctor (licensenum, firstname, lastname, licensedate, birthdate, hosworksat, speciality) VALUES 
            ('$licensenum', '$firstname', '$lastname', '$licensedate', '$birthdate', '$hosworksat', '$speciality')";
        $result = mysqli_query($conn, $query);
        if (!$result) {
            die("databases query failed.");
        }
        echo "<p>Doctor successfully created</p>";
    }
    

?>