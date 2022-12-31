<?php

$conn_servername = "indyandy.net";
$conn_username = "indyandy_myriware";
$conn_password = trim(file_get_contents("../../../data/_"));
$common_id = trim($_GET['id']);

$return_array = array();

try {
    $conn = new PDO("mysql:host=$conn_servername;dbname=indyandy_myriware", $conn_username, $conn_password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //start
    $stmt = $conn->prepare("
SELECT Reg.CommonRole, Dat.USERNAME, Dat.FIRSTNAME, Dat.MIDNAME, Dat.LASTNAME, Dat.UUID
FROM CommonsRegistry Reg, UserData Dat
WHERE Reg.CommonUser = Dat.UUID AND Reg.CommonID='$common_id' 
");
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    //foreach(new RecursiveArrayIterator($stmt->fetchAll()) as $key=>$value) { }
    echo json_encode($stmt->fetchAll());
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

$conn = null;
?>