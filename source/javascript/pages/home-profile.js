// !IMPORTANT! This function has requirements: 'ajax.js'
function fillInformation() {
    const login_info = JSON.parse(LoadDoc('../../source/php/get_login.php', null));
    document.getElementById('FirstName').innerText = login_info['Name']['FirstName'];
    document.getElementById('MidName').innerText = login_info['Name']['MidName'];
    document.getElementById('LastName').innerText = login_info['Name']['LastName'];
    document.getElementById('FullName').innerText = login_info['Name']['FullName'];
    document.getElementById('Username').innerText = login_info['ID']['Username'];
    document.getElementById('UUID').innerText = login_info['ID']['UUID'];
}
// !IMPORTANT! This function has requirements: 'ajax.js'
function fillCommons() {
    const commons_area = document.getElementById('registeredCommons');
    const registered_commons = JSON.parse(LoadDoc('../commons/get_registered.php',null));
    for (let i=0; i<registered_commons.Admin.length; i++) {
        commons_area.innerHTML += `
                    <div class="card">
                        <p>Common ID: ${registered_commons.Admin[i]}</p>
                        <p>Role: Admin</p>
                        <a href='../commons/edit.php?common_id=${registered_commons.Admin[i]}'>Edit</a> | <a href='../commons/view.php?common_id=${registered_commons.Admin[i]}'>View</a>
                    </div>`;
    }
    for (let i=0; i<registered_commons.Editor.length; i++) {
        commons_area.innerHTML += `
                    <div class="card">
                        <p>Common ID: ${registered_commons.Editor[i]}</p>
                        <p>Role: Editor</p>
                        <a href='../commons/edit.php?common_id=${registered_commons.Editor[i]}'>Edit</a> | <a href='../commons/view.php?common_id=${registered_commons.Editor[i]}'>View</a>
                    </div>`;
    }
    for (let i=0; i<registered_commons.Looker.length; i++) {
        commons_area.innerHTML += `
                    <div class="card">
                        <p>Common ID: ${registered_commons.Looker[i]}</p>
                        <p>Role: Looker</p>
                        <a href='../commons/view.php?common_id=${registered_commons.Looker[i]}'>View</a>
                    </div>`;
    }
}