<html>
    <head>
        <title>Editing Common</title>
        <?php $files_needed = array('commons-edit', true, true, 'changeTitle(load()); updateFiles();'); include "../../source/header.php"; ?>
    </head>
    <body>
        <div class='dual-container'>
            <!--navigation area saveFile(document.getElementById('currentFile').value);-->
            <div class='card'>
                <h3 style='text-align:center;'>Files</h3>
                <div class='utility'>
                    <p onclick='window.location = "../home/profile.php"'>Home</p>
                    <p onclick='openCommonData()'>Common Data</p>
                    <p onclick='openFileManager()'>File Manager</p>
                </div>
                <hr>
                <div id='directory'></div>
                <meter id='progressBar' style='display:none;' min='0' max='0' value='0'></meter>
            </div>
            <!--editing area-->
            <div class='card' id='showArea'>
                <input
                    type='hidden'
                    id='currentFile'
                    value=''>
                <textarea
                    id='fileEditor'
                    class='font-Share_Tech_Mono'
                    style='display:block;resize:none;'></textarea>
                <div 
                    id='commonInfo'
                    class='font-Share_Tech_Mono'
                    style='display:none;'></div>
                <div 
                    id='fileManager'
                    class='font-Share_Tech_Mono'
                    style='display:none;'>
                    <h3>Files</h3>
                    <button onclick='refresh()'>Refresh</button> | <button onclick='createFile()'>Add</button><input type='text' name='newFileName' id='newFileName'>
                    <table id='tableManager' style='width:100%;'>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>