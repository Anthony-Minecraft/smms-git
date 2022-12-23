function LoadDoc(URL, meterBar) {
    let using_meter = false;
    if (meterBar != null) {
        using_meter = true;
    }
    move_progress(using_meter, meterBar, 1);
    function move_progress(canMove, bar, amount) {
        if (canMove) {
            bar.value = amount;
        }
    }
    let Info = "";
    var xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        Info = this.responseText;
        move_progress(using_meter, meterBar, 3);
    };
    xhttp.open("GET", URL, false);
    move_progress(using_meter, meterBar, 2);
    xhttp.send();
    return Info;
}