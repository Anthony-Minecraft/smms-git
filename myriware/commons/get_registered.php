<?php
session_start();
$conn_servername = "indyandy.net";
$conn_username = "indyandy_myriware";
$conn_password = trim(file_get_contents("../../data/_"));
$user = $_SESSION['login']['ID']['UUID'];

$return_data = array(
    'Admin'=>array(),
    'Editor'=>array(),
    'Looker'=>array()
);

try {
    $conn = new PDO("mysql:host=$conn_servername;dbname=indyandy_myriware", $conn_username, $conn_password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //start
    $stmt = $conn->prepare("SELECT CommonID, CommonRole FROM CommonsRegistry WHERE CommonUser='$user'");
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    foreach(new RecursiveArrayIterator($stmt->fetchAll()) as $key=>$value) {
        switch($value['CommonRole']) {
            case 'admin':
                array_push($return_data['Admin'], $value['CommonID']);
                break;
            case 'editor':
                array_push($return_data['Editor'], $value['CommonID']);
                break;
            case 'looker':
                array_push($return_data['Looker'], $value['CommonID']);
                break;
        }
    }
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

$conn = null;
echo json_encode($return_data);
?>