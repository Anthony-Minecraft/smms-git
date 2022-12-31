<?php
$file = '../../../commons/' . trim($_GET['common_id']) . '/' . trim($_GET['file_name']);
unlink($file);
echo $file;
?>