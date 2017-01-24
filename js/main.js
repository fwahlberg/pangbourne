document.getElementById("pangbutton").disabled = true;
let errors = "";
let oDist     = document.getElementById('distance').value;
let oTime     = printTime();
function calculator() {
    let oDist     = document.getElementById('distance').value;
    let oTime     = printTime();
    let name      = document.getElementById('name').value;
    let weight    = document.getElementById('weight').value;
    let split     = splittime();
    let wf        = weightf();
    let wadist    = wfdist();
    let watime    = wftime();    
    let outputer  = "<tr><td><b>" + toTitleCase(name) + "</b></td><td>" + weight + "</td><td>" + oDist + "</td><td>" + oTime + "</td><td>" + split + "</td><td>" + wadist + "</td><td>" + watime + "</td></tr>";
    let div       = document.getElementById('resultArea');
    div.innerHTML = div.innerHTML + outputer;
};

function weightf() {
    let kg = document.getElementById('weight').value;
    kg = kg * 2.20462;
    let wf = (kg / 270);
    wf = Math.pow(wf, 0.222);
    wf = wf.toFixed(3);
    return wf;
};

/*function calculatesecs(secs){
   secs = secs.split(":");
   return secs[0] * (60 * 60) + secs[1] * 60 + secs[2] * 1;
};*/
function splittime() {
    let time = timetosecs();
    if(time == 0 || document.getElementById('distance').value == 0){
        return 0;
    }
    time = 500 * (time/document.getElementById('distance').value);
    return secstotime(time);
};

function timetosecs() {
    let hrs = document.getElementById('hours').value;
    let mins = document.getElementById('minutes').value;
    let secs = document.getElementById('seconds').value;
    return hrs * (60 * 60) + mins * 60 + secs * 1;
};

function secstotime(totalSeconds) {
    if (totalSeconds == "Infinity"){
        return 0;
    } else{
    let hours = Math.floor(totalSeconds / 3600);
    totalSeconds %= 3600;
    let minutes = pad(Math.floor(totalSeconds / 60));
    let seconds = pad(Math.round((totalSeconds % 60) * 10) / 10)
    return hours + ":" + minutes + ":" + seconds;
    }
    
};

function wfdist() {
    let wf = weightf();
    let dist = document.getElementById('distance').value;
    dist = dist / wf;
    dist = Math.floor(dist);
    return dist
};

function wftime() {
    let wf = weightf();
    let time = timetosecs();
    return secstotime(wf * time);
};

function pad(num) {
    var s = num+"";
    while (s.length < 2) s = "0" + s;
    return s;
}

function printTime() {
    let oTime = timetosecs();
    return secstotime(oTime);
}

function toTitleCase(str) {
    return str.replace(/\w\S*/g, function(txt) {
        return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
    });
};



function failedimage() {
    document.getElementById("logo").style.display = "none";
    document.getElementById("title").style.display = "block";
};


$(document).ready(function() {
    $("button").click(function() {

        $.post("post.php", {
                idKey: $("#key").val(),
                aFactor: weightf,
                name: $("#name").val(),
                weight: $("#weight").val(),
                oDistance: $("#distance").val(),
                oTime: printTime(),
                aDistance: wfdist(),
                aTime: wftime(),
                split: splittime()
            },
            function(data, status) {
                if(status != "success"){
                    alert("Something went wrong!");
                }
            });
    });
});