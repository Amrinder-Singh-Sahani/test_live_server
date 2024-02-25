<?php

$server = "localhost";
$username = "root";
$servpass = "";
$dbname = "trackj";
$con = mysqli_connect($server, $username, $servpass, $dbname);

if (!$con) {
    echo "Cannot establish connection due to error " .mysqli_connect_error();
}


// $getName = $_GET['name'];
$getEmail = $_GET['email'];
$getPassword = $_GET['pass'];
// $getPhone = $_GET['phone_no'];
// $getCurrent_location = $_GET['currentLocation'];
// $getVisitLocation = $_GET['visitLocation'];
$getEmail = mysqli_real_escape_string($con, $getEmail);
$getPassword = mysqli_real_escape_string($con, $getPassword);
$hash = password_hash($getPassword, PASSWORD_ARGON2ID);

// $getName = mysqli_real_escape_string($con, $getName);
$getEmail = mysqli_real_escape_string($con, $getEmail);

$sql = "SELECT email,pass FROM baseinfo WHERE email = '$getEmail'";

$result = mysqli_query($con, $sql);

if(mysqli_num_rows($result)>0)
{
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $hash = $row['pass'];
    $valid = password_verify($getPassword, $hash);
    if($valid)
    {
        header('location: getType.html');
        exit;
    }
    else
    {
        echo "Invalid";
    }
} else {
    echo "Invalid email.";
}

}
else
{
    echo "This email is not registered!";
}

$con->close();

?>