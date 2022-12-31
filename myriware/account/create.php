<?php

include '../../source/php/uuid.php';

$user_uuid = gen_uuid();
$username = trim($_POST["CreateUsername"]);
$password = trim($_POST["CreatePassword"]);

//sql stuff

$conn_servername = "indyandy.net";
$conn_username = "indyandy_myriware";
$conn_password = trim(file_get_contents("../../data/_"));

$first_name = trim($_POST["FirstName"]);
$last_name  = trim($_POST["LastName"]);
$mid_name   = trim($_POST["MidName"]);
$email      = trim($_POST["Email"]);

try {
  $conn = new PDO("mysql:host=$conn_servername;dbname=indyandy_myriware", $conn_username, $conn_password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  //start
  $sql = "INSERT INTO UserData (UUID, Username, FirstName, LastName, MidName, Email, `Password`)
  VALUES ('$user_uuid', '$username', '$first_name', '$last_name', '$mid_name', '$email', '$password')";
  $conn->exec($sql);
  //end
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}

$conn = null;

header("Location: ./login.php?new_user=yes&uuid=$user_uuid&password=$password");
?>