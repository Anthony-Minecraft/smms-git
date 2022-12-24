//get data
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
//post data
//https://stackoverflow.com/questions/18169933/submit-form-without-reloading-page
function submitForm(URL, params) {
    //console.log('Submitting data to: ' + URL + '? Submitting headers of: ' + params);
    var http = new XMLHttpRequest();
    http.open("POST", URL, true);
    http.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    http.send(params);
    let return_data;
    http.onload = function() {
        return_data = this.responseText;
    }
    return return_data;
}