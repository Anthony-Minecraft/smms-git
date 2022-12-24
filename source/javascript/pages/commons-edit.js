function load() {
    const url_params = parseURLParams(document.location.href);
    return JSON.parse(LoadDoc('edit/get_common_info.php?id=' + url_params.common_id,null))[0];
}

function changeTitle(common_info) {
    document.getElementsByTagName('title')[0].innerText = 'Editing Common ' + common_info.CommonName;
}

function createFile() {
    const url_params = parseURLParams(document.location.href);
    let new_file_name = document.getElementById('newFileName').value;
    LoadDoc('edit/create_file.php?file_name=' + new_file_name + '&common_id=' + url_params.common_id, null);
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

function openFile(fileName) {
    const url_params = parseURLParams(document.location.href);
    saveFile(document.getElementById('currentFile').value);
    document.getElementById('currentFile').value = fileName;
    document.getElementById('fileEditor').value = LoadDoc(`edit/get_file_contents.php?id=${url_params.common_id}&file_name=${fileName}`, null);
}