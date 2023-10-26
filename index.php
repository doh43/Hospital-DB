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

<div id="menu">
    <ul>
        <li><a href="doctorsinfo.php">Doctors Information</a></li>
        <li><a href="adddoctor.php">Add Doctor</a></li>
        <li><a href="removedoctor.php">Remove Doctor</a></li>
        <li><a href="assigndoctopat.php">Assign Doctor to Patient</a></li>
        <li><a href="docpatinfo.php">List Patients Treated by Doctor</a></li>
        <li><a href="hosinfo.php">Hospitals Information</a></li>
        <li><a href="updatebeds.php">Update Beds at Hospital</a></li>
    </ul>
</div>
    
</body>
</html>