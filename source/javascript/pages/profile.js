function fillInformation() {
    const login_info = JSON.parse(LoadDoc('../../source/php/get_login.php', null));
    document.getElementById('FirstName').innerText = login_info['Name']['FirstName'];
    document.getElementById('MidName').innerText = login_info['Name']['MidName'];
    document.getElementById('LastName').innerText = login_info['Name']['LastName'];
    document.getElementById('FullName').innerText = login_info['Name']['FullName'];
    document.getElementById('Username').innerText = login_info['ID']['Username'];
    document.getElementById('UUID').innerText = login_info['ID']['UUID'];
}

function setBackgroundImage(image) {
    LoadDoc(`../../source/php/change_background.php?image=${image}`);
    checkForBackground();
}