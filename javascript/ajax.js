function LoadDoc(URL) {
    let Info = "";
    var xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        Info = this.responseText;
    };
    xhttp.open("POST", URL, false);
    xhttp.send();
    return Info;
}