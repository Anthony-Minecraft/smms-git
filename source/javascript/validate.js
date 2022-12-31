// !IMPORTANT! This function has requirements: 'ajax.js'
function checkLogin() {
    const login_doc = LoadDoc('../../source/php/get_login.php', null);
    console.log(login_doc);
    const login = JSON.parse(login_doc);
    if (login == null) {
        document.location.href = '../../index.html?error=no_login';
    }
}

function showpsw(elementId) {
    var field = document.getElementById(elementId);
    if (field.type === "password") {
        field.type = "text";
    } else {
        field.type = "password";
    }
}
