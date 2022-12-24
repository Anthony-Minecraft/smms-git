<?php
$items = scandir('../../../commons/' . trim($_GET['id']));
$return = array();
foreach($items as $item) {
    switch($item) {
        case '.':
        case '..':
            break;
        default:
            array_push($return, $item);
    }
}
echo json_encode($return);
?>