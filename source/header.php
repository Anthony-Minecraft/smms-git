        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--CSS packaged defaults-->
        <link rel="stylesheet" href="../../source/css/_packaged.css">
        <!--Custom CSS for this page-->
<?php
if ($files_needed[1] === true) {
        echo "        <link rel=\"stylesheet\" href=\"../../source/css/pages/" . $files_needed[0] . ".css\">\n";
} elseif (gettype($files_needed[1]) === "string") { 
        echo "        <link rel=\"stylesheet\" href=\"../../source/css/pages/" . $files_needed[1] . ".css\">\n";
} else {
        echo "        <!--No additional CSS-->\n";
}
?>
        <!--JS default includes (php to include)-->
<?php
foreach(json_decode(file_get_contents('../../source/javascript/_package.json'), true)['Default'] as $js_file) {
        echo "        <script src=\"../../source/javascript/$js_file\"></script>\n";
}
?>
        <script>checkLogin(); window.onload = function() { checkForBackground(); <?php echo $files_needed[3] ?> };</script>
        <!--Custom JS for this page-->
<?php
if ($files_needed[2]) {
        echo "        <script src=\"../../source/javascript/pages/" . $files_needed[0] . ".js\"></script>\n";
} else {
        echo "        <!--No additional JS-->\n";
}
?>