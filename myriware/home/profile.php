<html>
    <head>
        <title>Profile</title>
        <?php $files_needed = array('profile', true, true); include "../../source/header.php"; ?>
        <script> window.onload = function() { fillInformation(); } </script>
    </head>
    <body>
        <div class="card">
            <div class="container name-container">
                <h1>Profile</h1>
                <h2>Name</h2>
                <p>First: <span id="FirstName"></span></p>
                <p>Middle: <span id="MidName"></span></p>
                <p>Last: <span id="LastName"></span></p>
                <p>Full: <span id="FullName"></span></p>
                <h2>ID</h2>
                <p>Username: <span id="Username"></span></p>
                <p>UUID : <span id="UUID"></span></p>
                <br>
                <a href="../account/logout.php">Logout</a>
                <h1>Background</h1>
                <p>Select a picture to use as a background</p>
                <div class='bg-image-container'>
                    <div>
                        <img
                            data-img='backgroundImage01'
                            onclick='setBackgroundImage("backgroundImage01")'
                            src='../../source/image/background/backgroundImage01.png'
                            alt='Welcoming Shapes'>
                        <p>Welcoming Shapes</p>
                    </div>
                    <div>   
                        <img
                            data-img='backgroundImage02'
                            onclick='setBackgroundImage("backgroundImage02")'
                            src='../../source/image/background/backgroundImage02.png'
                            alt='Hexamania'>
                        <p>Hexamania</p>
                    </div>
                </div>
                <h1>Commons</h1>
                <i>This feature is still InDev, so please be patiant!</i>
            </div>
        </div>
    </body>
</html>