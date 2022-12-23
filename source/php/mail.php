<?php

$to = $_POST['to'];
$subject = $_POST['subject'];
$content = $_POST['content'];

// use wordwrap() if lines are longer than 70 characters
$content = wordwrap($content,70);

// send email
mail($to,$subject,$content);

if ($_POST['redirect'] === 'true') {
    header("Location: " . $_POST['redirect_link']);
}

?>