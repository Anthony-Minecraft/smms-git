<html>
    <head>
        <title>Profile</title>
        <?php $files_needed = array('home-profile', true, true, 'fillInformation(); fillCommons();'); include "../../source/header.php"; ?>
    </head>
    <body>
        <div class="card">
            <div class="container name-container">
                <h1>Profile</h1>
                <h2>Name</h2><p>First: <span id="FirstName"></span></p><p>Middle: <span id="MidName"></span></p><p>Last: <span id="LastName"></span></p><p>Full: <span id="FullName"></span></p>
                <h2>ID</h2><p>Username: <span id="Username"></span></p><p>UUID : <span id="UUID"></span></p>
                <br><a href="../account/logout.php">Logout</a>
                <h1>Background</h1><p>Select a picture to use as a background</p>
                <div class='dual-container center-align'>
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
                <div class='dual-container' id='registeredCommons'>
                    <div class="card" style='grid-column: 1 / span 2;'>
                        <form method='post' action='../commons/create.php'>
                            <input
                                type='text'
                                name='Name'
                                placeholder='Common Name'><br>
                            <textarea
                                placeholder='Common Description (max 1000 chars)'
                                name='Description'
                                style='width:100%;height:60px;resize:vertical;'></textarea><br>
                            <button type='submit'>Create</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>