<?php
$conn_servername = "indyandy.net";
$conn_username = "indyandy_myriware";
$conn_password = trim(file_get_contents("../../data/_"));

try {
  $conn = new PDO("mysql:host=$conn_servername;dbname=indyandy_myriware", $conn_username, $conn_password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  //start
  $stmt = $conn->prepare("SELECT FIRSTNAME, LASTNAME, MIDNAME, USERNAME FROM UserData WHERE UUID='" . $_GET['uuid'] . "'");
  $stmt->execute();
  $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
  foreach(new RecursiveArrayIterator($stmt->fetchAll()) as $key=>$value) {
    $ID_array = array(
        "UUID"=>$_GET['uuid'],
        "Username"=>trim($value['USERNAME'])
    );
    $name_array = array(
        "FirstName"=>$value["FIRSTNAME"],
        "MidName"=>$value["MIDNAME"],
        "LastName"=>$value["LASTNAME"],
        "FullName"=>$value["FIRSTNAME"] . " " . $value["MIDNAME"] . " " . $value["LASTNAME"]
    );
    $login = array(
        "ID"=>$ID_array,
        "Name"=>$name_array
    );
  }
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}

$conn = null;
echo json_encode($login);

?>