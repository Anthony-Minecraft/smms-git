const url_params = parseURLParams(document.location.href);
let progress_bar;

function load() {
    const url_params = parseURLParams(document.location.href);
    return JSON.parse(LoadDoc('edit/get_common_info.php?id=' + url_params.common_id,null))[0];
}

function changeTitle(common_info) {
    document.getElementsByTagName('title')[0].innerText = 'Editing Common ' + common_info.CommonName;
    if(!window.location.hash == '') {
        if (window.location.hash === '#CommonInfo') {
            openCommonData();
        } else if (window.location.hash === '#FileManager') {
            openFileManager();
        } else {
            openFile(window.location.hash.replace('#', ''));
        }
    }
}

function createFile() {
    let new_file_name = document.getElementById('newFileName').value;
    LoadDoc('edit/create_file.php?file_name=' + new_file_name + '&common_id=' + url_params.common_id, null);
    refresh();
}

function removeFile(fileName) {
    console.log(LoadDoc('edit/remove_file.php?file_name=' + fileName + '&common_id=' + url_params.common_id, null));
    refresh();
}

function updateFiles() {
    const files = JSON.parse(LoadDoc('edit/get_files.php?id=' + url_params.common_id,null));
    const directoryArea = document.getElementById('directory');
    directoryArea.innerHTML = '';
    for (let i=0; i<files.length; ++i) {
        directoryArea.innerHTML += `<div><p onclick='openFile("${files[i]}"); saveDialog("${files[i]}");'>${files[i]}</p><span id='fileMenu-${files[i]}'></span></div>`;
    }
}

function clearSaveDialogs() {
    const children = document.getElementById('directory').getElementsByTagName('div');
    for (const child of children) {
        const div = child.children[1];
        div.innerHTML = '';
    }
}

function saveDialog(fileName) {
    clearSaveDialogs();
    const element = document.getElementById('fileMenu-' + fileName);
    const inner_HTML = `<button onclick='saveFile("${fileName}")'>Save</button>`;
    element.innerHTML = inner_HTML;
}

function saveFile(fileName) {
    const url_params = parseURLParams(document.location.href);
    let content = document.getElementById('fileEditor').value;
    submitForm(`edit/save_file.php?file_name=${fileName}&id=${url_params.common_id}`, 'file_content=' + content);
}

function openPage(fileName) {
    window.open(`../../commons/${url_params.common_id}/${fileName}`, '_blank');
}

function openFile(fileName) {
    changeView('fileEditor');
    const url_params = parseURLParams(document.location.href);
    saveFile(document.getElementById('currentFile').value);
    document.getElementById('currentFile').value = fileName;
    document.getElementById('fileEditor').value = LoadDoc(`edit/get_file_contents.php?id=${url_params.common_id}&file_name=${fileName}`, null);
    window.location.href = '#' + fileName;
}

function setupProgressBar(bar, min, max, value) {
    progress_bar = document.getElementById(bar);
    progress_bar.style.display = 'block';
    progress_bar.min = min;
    progress_bar.max = max;
    progress_bar.value = value;
}

function changeProgress(bar, amount) {
    bar.value = parseInt(bar.value) + amount;
}

function openCommonData() {
    window.location.href = '#CommonInfo';
    changeView('commonInfo');
    saveFile(document.getElementById('currentFile').value);
    const common_info = load();
    const url_params = parseURLParams(document.location.href);
    const owner_doc = LoadDoc(`../account/get_record.php?uuid=${common_info.CommonOwner}`,null);
    const owner_data = JSON.parse(owner_doc);
    const display_info = `
<h3>Common Info</h3>
<p>Name: ${common_info.CommonName}</p>
<p>Description: ${common_info.CommonDescription}</p>
<p>ID: ${url_params.common_id}</p>
<p class='indent'>Owner: ${common_info.CommonOwner}</p>
<p class='indent'>Name: ${owner_data.Name.FullName}</p>
<p class='indent'>User: ${owner_data.ID.Username}</p>
<p>Invite Link: ${window.location.hostname}/myriware/commons/join.php?id=${url_params.common_id}</p>
<p>Veiw link: ${window.location.hostname}/commons/${url_params.common_id}/[page name]
<h3>Other Commoners</h3>
<div id='OtherCommoners'></div>
    `;
    document.getElementById('commonInfo').innerHTML = display_info;
    fillOtherCommers();
}

function fillOtherCommers() {
    const others_div = document.getElementById('OtherCommoners');
    others_div.innerHTML = '';
    const doc = LoadDoc('edit/get_commoners.php?id=' + url_params.common_id, null);
    const others = JSON.parse(doc);
    const login_data = JSON.parse(LoadDoc('../../source/php/get_login.php',null));
    let admin = false;
    if (load().CommonOwner === login_data.ID.UUID) {
        admin = true;
    }
    for (let i=0; i<others.length; ++i) {
        const other = others[i];
        const full_name = other.FIRSTNAME + ' ' + other.MIDNAME + ' ' + other.LASTNAME;
        let fill_data = `
<h4>${full_name} | ${other.CommonRole}</h4>
<p>Username: ${other.USERNAME}</p>
<p>UUID: ${other.UUID}</p>
        `;
if (admin && other.UUID !== login_data.ID.UUID) {
    fill_data += `
<p>Change Role: <button onclick='changeRole("${other.UUID}","looker")'>Looker</button> <button onclick='changeRole("${other.UUID}","editor")'>Editor</button></p>
    `;
}
        others_div.innerHTML += fill_data;
    }
}

function changeRole(user, role) {
    LoadDoc(`edit/change_role.php?id=${url_params.common_id}&role=${role}&user=${user}`,null);
    fillOtherCommers();
}

function openFileManager() {
    window.location.href = '#FileManager';
    changeView('fileManager');
    saveFile(document.getElementById('currentFile').value);
    const files = JSON.parse(LoadDoc('edit/get_files.php?id=' + url_params.common_id,null));
    const file_area = document.getElementById('tableManager');
    file_area.innerHTML = '';
    try {
        for (let i=0; i<files.length; ++i) {
            let row = document.createElement('tr');
            let file_name = document.createElement('td');
            file_name.innerHTML = `<div onclick='openFileInManager("${files[i]}")'><p>${files[i]}</p><span id='fileManager-${files[i]}'></span></div>`;
            row.appendChild(file_name);
            file_area.appendChild(row);
        }
    } catch (error) {
        console.log('This is expected after deleting a file');
    }
}

function clearFileManager() {
    //get rid of other opens
    const children = document.getElementById('tableManager').getElementsByTagName('tr');
    for (const child of children) {
        const div = child.children[0].children[0].children[1];
        div.innerHTML = '';
    }
}

function openFileInManager(fileName) {
    clearFileManager();
    //set the file selected
    const element = document.getElementById('fileManager-' + fileName);
    element.innerHTML = `<button onclick='removeFile("${fileName}")'>Delete</button><button onclick='openFile("${fileName}")'>Open Editor</button><button onclick='openPage("${fileName}")'>Open Page</button>`;
}   

function changeView(to) {
    const show_area_children = document.getElementById('showArea').children;
    for (const view of show_area_children) {
        view.style.display = 'none';
    }
    document.getElementById(to).style.display = 'block';
}

function refresh() {
    updateFiles();
    openFileManager();
}