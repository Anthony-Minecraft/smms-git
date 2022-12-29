const url_params = parseURLParams(document.location.href);

function openPage() {
    window.open(`../../commons/${url_params.common_id}/${document.getElementById('currentFile').value}`, '_blank');
}

function openFile(fileName) {
    document.getElementById('fileEditor').style.display = 'block';
    document.getElementById('commonInfo').style.display = 'none';
    document.getElementById('currentFile').value = fileName;
    document.getElementById('fileEditor').value = LoadDoc(`edit/get_file_contents.php?id=${url_params.common_id}&file_name=${fileName}`, null);
    window.location.href = '#' + fileName;
}

function openCommonData() {
    window.location.href = '#CommonInfo';
    document.getElementById('fileEditor').style.display = 'none';
    document.getElementById('commonInfo').style.display = 'block';
    const common_info = load();
    const owner_data = JSON.parse(LoadDoc(`../account/get_record.php?uuid=${common_info.CommonOwner}`,null));
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
    `;
    document.getElementById('commonInfo').innerHTML = display_info;
}

function updateFiles() {
    const files = JSON.parse(LoadDoc('edit/get_files.php?id=' + url_params.common_id,null));
    const directoryArea = document.getElementById('directory');
    directoryArea.innerHTML = '';
    for (let i=0; i<files.length; ++i) {
        directoryArea.innerHTML += `<p onclick='openFile("${files[i]}")'>${files[i]}</p>`;
    }
}

function load() {
    return JSON.parse(LoadDoc('edit/get_common_info.php?id=' + url_params.common_id,null))[0];
}

function changeTitle(common_info) {
    document.getElementsByTagName('title')[0].innerText = 'Editing Common ' + common_info.CommonName;
    if(!window.location.hash == '') {
        openFile(window.location.hash.replace('#', ''));
    }
}