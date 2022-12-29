const url_params = parseURLParams(document.location.href);

function load() {
    const url_params = parseURLParams(document.location.href);
    return JSON.parse(LoadDoc('edit/get_common_info.php?id=' + url_params.common_id,null))[0];
}

function changeTitle(common_info) {
    document.getElementsByTagName('title')[0].innerText = 'Editing Common ' + common_info.CommonName;
    if(!window.location.hash == '') {
        if (window.location.hash === 'CommonInfo') {
            openCommonData();
        } else {
            openFile(window.location.hash.replace('#', ''));
        }
    }
}

function createFile() {
    const url_params = parseURLParams(document.location.href);
    let new_file_name = document.getElementById('newFileName').value;
    LoadDoc('edit/create_file.php?file_name=' + new_file_name + '&common_id=' + url_params.common_id, null);
    updateFiles();
}

function removeFile() {
    const url_params = parseURLParams(document.location.href);
    LoadDoc('edit/remove_file.php?file_name=' + document.getElementById('currentFile').value + '&common_id=' + url_params.common_id, null);
    updateFiles();
}

function updateFiles() {
    const url_params = parseURLParams(document.location.href);
    const files = JSON.parse(LoadDoc('edit/get_files.php?id=' + url_params.common_id,null));
    const directoryArea = document.getElementById('directory');
    directoryArea.innerHTML = '';
    for (let i=0; i<files.length; ++i) {
        directoryArea.innerHTML += `<p onclick='openFile("${files[i]}")'>${files[i]}</p>`;
    }
}

function saveFile(fileName) {
    const url_params = parseURLParams(document.location.href);
    let content = document.getElementById('fileEditor').value;
    //console.log('logging contents as: ' + content);
    submitForm(`edit/save_file.php?file_name=${fileName}&id=${url_params.common_id}`, 'file_content=' + content);
}

function openPage() {
    window.open(`../../commons/${url_params.common_id}/${document.getElementById('currentFile').value}`, '_blank');
}

function openFile(fileName) {
    document.getElementById('fileEditor').style.display = 'block';
    document.getElementById('commonInfo').style.display = 'none';
    const url_params = parseURLParams(document.location.href);
    saveFile(document.getElementById('currentFile').value);
    document.getElementById('currentFile').value = fileName;
    document.getElementById('fileEditor').value = LoadDoc(`edit/get_file_contents.php?id=${url_params.common_id}&file_name=${fileName}`, null);
    window.location.href = '#' + fileName;
}

function openCommonData() {
    window.location.href = '#CommonInfo';
    document.getElementById('fileEditor').style.display = 'none';
    document.getElementById('commonInfo').style.display = 'block';
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
    const url_params = parseURLParams(document.location.href);
    const others_div = document.getElementById('OtherCommoners');
    const others = JSON.parse(LoadDoc('edit/get_commoners.php?id=' + url_params.common_id, null));
    for (let i=0; i<others.length; ++i) {
        const other = others[i];
        let fill_data = `
<h4>${other.Profile.Name.FullName} | ${other.Role}</h4>
<p>Username: ${other.Profile.ID.Username}</p>
<p>UUID: ${other.Profile.ID.UUID}</p>
        `;
        others_div.innerHTML += fill_data;
    }
}