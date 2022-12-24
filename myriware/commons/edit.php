<html>
    <head>
        <title>Editing Common</title>
        <?php $files_needed = array('commons-edit', true, true, 'changeTitle(load()); updateFiles()'); include "../../source/header.php"; ?>
    </head>
    <body>
        <div class='dual-container'>
            <!--navigation area-->
            <div class='card'>
                <h3 style='text-align: center;'>Files</h3>
                <button style='width: 10%; text-align: center;' onclick='createFile()'>+</button><input style='width: 90%;' type='text' name='newFileName' id='newFileName'>
                <br>
                <div id='directory'>
                    
                </div>
            </div>
            <!--editing area-->
            <div class='card'>
                <input type='hidden' id='currentFile' value=''>
                <textarea id='fileEditor'></textarea>
            </div>
        </div>
    </body>
</html>