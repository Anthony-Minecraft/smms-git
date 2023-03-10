<?php
session_start();
function gen_uuid() {
    $uuid = array(
        'time_low'  => 0,
        'time_mid'  => 0,
        'time_hi'  => 0,
        'clock_seq_hi' => 0,
        'clock_seq_low' => 0,
        'node'   => array()
    );

    $uuid['time_low'] = mt_rand(0, 0xffff) + (mt_rand(0, 0xffff) << 16);
    $uuid['time_mid'] = mt_rand(0, 0xffff);
    $uuid['time_hi'] = (4 << 12) | (mt_rand(0, 0x1000));
    $uuid['clock_seq_hi'] = (1 << 7) | (mt_rand(0, 128));
    $uuid['clock_seq_low'] = mt_rand(0, 255);

    for ($i = 0; $i < 6; $i++) {
        $uuid['node'][$i] = mt_rand(0, 255);
    }

    $uuid = sprintf('%08x-%04x-%04x-%02x%02x-%02x%02x%02x%02x%02x%02x',
        $uuid['time_low'],
        $uuid['time_mid'],
        $uuid['time_hi'],
        $uuid['clock_seq_hi'],
        $uuid['clock_seq_low'],
        $uuid['node'][0],
        $uuid['node'][1],
        $uuid['node'][2],
        $uuid['node'][3],
        $uuid['node'][4],
        $uuid['node'][5]
    );

    return $uuid;
}

$common_name = trim($_POST['Name']);
$common_description = trim($_POST['Description']);
$common_owner = $_SESSION['login']['ID']['UUID'];
$common_ID = gen_uuid();

$conn_servername = "indyandy.net";
$conn_username = "indyandy_myriware";
$conn_password = trim(file_get_contents("../../data/_"));

//create data
try {
  $conn = new PDO("mysql:host=$conn_servername;dbname=indyandy_myriware", $conn_username, $conn_password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  //start
  $sql = "INSERT INTO CommonsSetup (CommonID, CommonOwner, CommonName, CommonDescription)
  VALUES ('$common_ID', '$common_owner', '$common_name', '$common_description')";
  $conn->exec($sql);
  //end
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}

$conn = null;

//add owner
try {
    $conn = new PDO("mysql:host=$conn_servername;dbname=indyandy_myriware", $conn_username, $conn_password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //start
    $sql = "INSERT INTO CommonsRegistry (CommonID, CommonUser, CommonRole)
    VALUES ('$common_ID', '$common_owner', 'admin')";
    $conn->exec($sql);
    //end
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

$conn = null;

mkdir("../../commons/$common_ID/");

header('Location: ../home/profile.php');

?>