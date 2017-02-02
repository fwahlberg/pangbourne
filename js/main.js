/*
DOM selectors
 */
const name     = document.querySelector('#name');
const weight   = document.querySelector('#weight');
const hours    = document.querySelector('#hours');
const minutes  = document.querySelector('#minutes');
const seconds  = document.querySelector('#seconds');
const distance = document.querySelector('#distance');
const pangButton = document.querySelector('#pangbutton');
pangButton.disabled = true;

function output() {  
    let outputer  = "<tr><td><b>" + htmlEntities(toTitleCase(name.value)) + "</b></td><td>" + htmlEntities(weight.value) + "</td><td>" + htmlEntities(distance.value) + "</td><td>" + printTime() + "</td><td>" + splittime() + "</td><td>" + wfdist() + "</td><td>" + wftime() + "</td></tr>";
    let div       = document.getElementById('resultArea');
    div.innerHTML = div.innerHTML + outputer;
};
/*
Weight Functions
 */
function weightf() {
    let kg = weight.value;
    kg = kg * 2.20462;
    let wf = (kg / 270);
    wf = Math.pow(wf, 0.222);
    wf = wf.toFixed(3);
    return wf;
}

/*
Time functions
 */
function splittime() {
    if(timetosecs() == 0 || distance.value == 0){
        return 0;
    }
    let time = 500 * (timetosecs()/distance.value);
    return secstotime(time);
};

function timetosecs() {
    return hours.value * (60 * 60) + minutes.value * 60 + seconds.value * 1;
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

function printTime() {
    let oTime = timetosecs();
    return secstotime(oTime);
}

/*
Weight factor functions
 */
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




/*
Formatting functions
 */
function toTitleCase(str) {
    return str.replace(/\w\S*/g, function(txt) {
        return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
    });
};

function htmlEntities(str) {
    return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
};

function pad(num) {
    var s = num+"";
    while (s.length < 2) s = "0" + s;
    return s;
}

function failedimage() {
    document.getElementById("logo").style.display = "none";
    document.getElementById("title").style.display = "block";
};


/*
Post function
 */
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

//Retired functions
/*function calculatesecs(secs){
/*  secs = secs.split(":");
/*   return secs[0] * (60 * 60) + secs[1] * 60 + secs[2] * 1;
/*};
*/