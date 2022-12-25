<html>
    <head>
        <title>Editing Common</title>
        <?php $files_needed = array('commons-edit', true, true, 'changeTitle(load()); updateFiles();'); include "../../source/header.php"; ?>
    </head>
    <body>
        <div class='dual-container'>
            <!--navigation area saveFile(document.getElementById('currentFile').value);-->
            <div class='card'>
                <h3 style='text-align: center;'>Files</h3>
                <a
                    style='font-size:10px;width:30%'
                    href='../home/profile.php'>Home</a>
                <button
                    style='font-size:10px;width:70%'
                    onclick='openPage()'>Go to page</button>
                <br>
                <button
                    style='font-size:10px;width:15%;text-align:center;margin:0;padding:0;'
                    onclick='createFile()'>Add</button><input
                    style='font-size:10px;width:85%;margin:0;padding:0;'
                    type='text'
                    name='newFileName'
                    id='newFileName'>
                <button
                    style='font-size:10px;width:70%;'
                    onclick='saveFile(document.getElementById("currentFile").value);'>Save</button><button
                    style='font-size:10px;width:30%;'
                    onclick='removeFile()'>Remove</button>
                <br>
                <p
                    style='margin:0;padding:0;'
                    onclick='openCommonData()'>Common Data</p>
                <div
                    id='directory'>
                    
                </div>
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
                    style='display:block;'></textarea>
                <div 
                    id='commonInfo'
                    class='font-Share_Tech_Mono'
                    style='display:none;'></div>
            </div>
        </div>
    </body>
</html>