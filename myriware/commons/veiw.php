<html>
    <head>
        <title>Editing Common</title>
        <?php $files_needed = array('commons-veiw', 'commons-edit', true, 'changeTitle(load()); updateFiles();'); include "../../source/header.php"; ?>
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