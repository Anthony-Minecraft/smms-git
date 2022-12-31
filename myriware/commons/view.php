<html>
    <head>
        <title>View Common</title>
        <?php $files_needed = array('commons-view', 'commons-edit', 'commons-edit', 'changeTitle(load()); updateFiles();'); include "../../source/header.php"; ?>
    </head>
    <body>
        <div class='dual-container'>
            <!--navigation area saveFile(document.getElementById('currentFile').value);-->
            <div class='card'>
                <h3 style='text-align:center;'>Files</h3>
                <div class='utility'>
                    <p onclick='window.location = "../home/profile.php"'>Home</p>
                    <p onclick='openCommonData()'>Common Data</p>
                </div>
                <hr>
                <div id='directory'></div>
            </div>
            <!--editing area-->
            <div class='card'>
                <input
                    type='hidden'
                    id='currentFile'
                    value=''>
                <textarea
                    id='fileEditor'
                    class='font-Share_Tech_Mono'
                    style='display:block;'
                    readonly></textarea>
                <div 
                    id='commonInfo'
                    class='font-Share_Tech_Mono'
                    style='display:none;'></div>
            </div>
        </div>
    </body>
</html>