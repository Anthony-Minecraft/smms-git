//Function to check and change the background
// !IMPORTANT! This function has requirements: 'ajax.js'
function checkForBackground() {
    const login_info = JSON.parse(LoadDoc('../../source/php/get_login.php', null));
    if (login_info['background'] != null) {
        document.getElementsByTagName('body')[0].classList.add(login_info['background']);
    }
}
// !IMPORTANT! This function has requirements: 'ajax.js'
function setBackgroundImage(image) {
    LoadDoc(`../../source/php/change_background.php?image=${image}`);
    checkForBackground();
}