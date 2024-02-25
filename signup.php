
<?php
// C:\xampp\htdocs\phtT\signup.php
$server = "localhost";
$username = "root";
$servpass = "";
$dbname = "trackj";
$con = mysqli_connect($server,$username,$servpass,$dbname);
if(!$con)
{
    echo "Cannot establish connection due to error ".mysqli_connect_error();
}

$getName = $_GET['name'];
$getEmail = $_GET['email'];
$getPassword = $_GET['pass'];
$confirmPass = $_GET['pass2'];
$getPhone = $_GET['phone_no'];
// $getCurrent_location = $_GET['currentLocation'];
// $getVisitLocation = $_GET['visitLocation'];

$getName = mysqli_real_escape_string($con, $getName);
$getEmail = mysqli_real_escape_string($con, $getEmail);
$getPassword = mysqli_real_escape_string($con, $getPassword);
$confirmPass = mysqli_real_escape_string($con, $confirmPass);
$getPhone = mysqli_real_escape_string($con, $getPhone);
$hash = password_hash($getPassword, PASSWORD_ARGON2ID);


$sql = "SELECT * FROM baseinfo WHERE email = '$getEmail'";
$result = mysqli_query($con, $sql);

if(mysqli_num_rows($result) > 0)
{
    echo "Email already in use!";
}
else
{
    if($getPassword != $confirmPass)
    {
        echo "Passwords do not match!";
    }
    
    else
    {
        $testsqli =  "INSERT INTO `trackj`.`baseinfo` (`name`, `phone`,`email`,`pass`,dt) 
VALUES ('$getName', '$getPhone','$getEmail', '$hash',current_timestamp());";
mysqli_query($con, $testsqli);
// echo $testsqli;
header('location: login.html');
    exit;
    
    };

    // echo "Registered Successfully";
    
}

// if($result == mysqli_query($con,$testsqli))
// {
//     echo "Successful";
// }
// else
// {
//     echo "Unable to insert into db";
// }


$con->close();

?>