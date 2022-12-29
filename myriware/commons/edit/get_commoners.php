<?php

function get_public_record($uuid) {
    $conn_servername = "indyandy.net";
    $conn_username = "indyandy_myriware";
    $conn_password = trim(file_get_contents("../../../data/_"));

    try {
    $conn = new PDO("mysql:host=$conn_servername;dbname=indyandy_myriware", $conn_username, $conn_password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //start
    $stmt = $conn->prepare("SELECT FIRSTNAME, LASTNAME, MIDNAME, USERNAME FROM UserData WHERE UUID='" . $uuid . "'");
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    foreach(new RecursiveArrayIterator($stmt->fetchAll()) as $key=>$value) {
        $ID_array = array(
            "UUID"=>$uuid,
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
        return $login;
    }
    } catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    }

    $conn = null;
}

$conn_servername = "indyandy.net";
$conn_username = "indyandy_myriware";
$conn_password = trim(file_get_contents("../../../data/_"));
$common_id = trim($_GET['id']);

$return_array = array();

try {
    $conn = new PDO("mysql:host=$conn_servername;dbname=indyandy_myriware", $conn_username, $conn_password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //start
    $stmt = $conn->prepare("SELECT CommonUser, CommonRole FROM CommonsRegistry WHERE CommonID='$common_id'");
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    foreach(new RecursiveArrayIterator($stmt->fetchAll()) as $key=>$value) {
        array_push($return_array,
        array(
            'ID'=>$value['CommonUser'],
            'Role'=>$value['CommonRole'],
            'Profile'=>get_public_record($value['CommonUser'])
        ));
    }
    //echo json_encode($stmt->fetchAll());
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

$conn = null;
echo json_encode($return_array);
?>