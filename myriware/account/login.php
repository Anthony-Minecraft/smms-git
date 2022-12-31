<?php
session_start();
$conn_servername = "indyandy.net";
$conn_username = "indyandy_myriware";
$conn_password = trim(file_get_contents("../../data/_"));

$login_username = trim($_POST["username"]);
$login_password = trim($_POST["password"]);

try {
  $conn = new PDO("mysql:host=$conn_servername;dbname=indyandy_myriware", $conn_username, $conn_password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  //start
  //check if it is a new account logging in
  if ($_GET['new_user'] === 'yes') {
    $login_password = $_GET['password'];
    $stmt = $conn->prepare("SELECT FirstName, LastName, MidName, `Password`, UserName FROM UserData WHERE UUID='" . $_GET['uuid'] . "'");
  } else {
    $stmt = $conn->prepare("SELECT FirstName, LastName, MidName, `Password`, UUID FROM UserData WHERE UserName='$login_username'");
  }
  $stmt->execute();
  $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
  $found = false;
  foreach(new RecursiveArrayIterator($stmt->fetchAll()) as $key=>$value) {
    $login_time = date('Y-m-l-d') . ' ' . date('H:i:s');
    if ($value["Password"] == $login_password) {
      if ($_GET['new_user'] === 'yes') {
        $login_username = $value['Username'];
      }
      file_put_contents('../../data/login_logs', "User " . $value["UUID"] . " [" . $login_username . "] successfully logged in on $login_time\n",FILE_APPEND);
      $found = true;
      $ID_array = array(
        "UUID"=>$value["UUID"],
        "Username"=>$login_username
      );
      $name_array = array(
        "FirstName"=>$value["FirstName"],
        "MidName"=>$value["MidName"],
        "LastName"=>$value["LastName"],
        "FullName"=>$value["FirstName"] . " " . $value["MidName"] . " " . $value["LastName"]
      );
      $_SESSION['login'] = array(
        "ID"=>$ID_array,
        "Name"=>$name_array,
        "Background"=>null,
        "Log_In_Time"=>$login_time
      );
      if ($_POST["URLInput"] == "") {
        header("Location: ../home/profile.php");
      } else {
        header('Location: ' . $_POST["URLInput"]);
      }
    } else {
      file_put_contents('../../data/login_logs', "User tried to use '$login_password' to log into '$login_username' on $login_time (INCORRECT PASSWORD)\n", FILE_APPEND);
      header("Location: ../../index.html?error=incorrect");
    }
  }
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}

$conn = null;
if (!$found) {
  file_put_contents('../../data/login_logs', "User tried to use '$login_password' to log into '$login_username' on $login_time (ACCOUNT DOES NOT EXIST)\n", FILE_APPEND);
  header("Location: ../../index.html?error=incorrect");
}

?>