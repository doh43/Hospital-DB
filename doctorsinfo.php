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
    <h1>Doctors Information</h1>
    <form action="doctorsinfo.php" method="POST">
        <h3>Sort doctors</h3>
        <input type="radio" id="lastname" name="orderby" value="lastname">
        <label for ="lastname">Last Name</label>
        <input type="radio" id="asc" name="sort" value="asc">
        <label for ="asc">Ascending</label><br>
        <input type="radio" id="birthdate" name="orderby" value="birthdate">
        <label for ="birthdate">Birthdate</label>
        <input type="radio" id="desc" name="sort" value="desc">
        <label for="desc">Descending</label><br>
        <label for="spec">Speciality</label>
        <select name="spec" id="spec">
            <option value="Any">Any</option>
            <?php
                $query = "SELECT DISTINCT(speciality) from doctor";
                $result = mysqli_query($conn, $query);
                if (!$result) {
                    die("databases query failed.");
                }
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value=" . $row["speciality"] . ">" . $row["speciality"] . "</option>";
                }
                mysqli_free_result($result);
            ?>
        </select>
        <button type="submit">sort</button>
    </form>
    <table>
        <tr>
            <th>License number</th>
            <th>First name</th>
            <th>Last name</th>
            <th>License date</th>
            <th>Birthdate</th>
            <th>Works at</th>
            <th>Speciality</th> 
        </tr>
        <?php
            include "getDoctorData.php";
        ?>
    </table>
</div>
    
</body>
</html>