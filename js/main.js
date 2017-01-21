document.getElementById("pangbutton").disabled = true;
let errors = "";

function calculator() {
    let oDist = document.getElementById('distance').value;
    let name = document.getElementById('name').value;
    let weight = document.getElementById('weight').value;
    let wf = weightf();
    let wadist = wfdist();
    let oTime = printTime();
    let watime = wftime();
    let outputer = "<tr><td><b>" + toTitleCase(name) + "</b></td><td>" + weight + "</td><td>" + oDist + "</td><td>" + oTime + "</td><td>" + wadist + "</td><td>" + watime + "</td></tr>";
    let div = document.getElementById('resultArea');
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

function timetosecs() {
    let hrs = document.getElementById('hours').value;
    let mins = document.getElementById('minutes').value;
    let secs = document.getElementById('seconds').value;
    return hrs * (60 * 60) + mins * 60 + secs * 1;
};

function secstotime(totalSeconds) {
    let hours = Math.floor(totalSeconds / 3600);
    totalSeconds %= 3600;
    let minutes = Math.floor(totalSeconds / 60);
    let seconds = Math.floor((totalSeconds % 60) * 10) / 10;
    return hours + ":" + minutes + ":" + seconds;
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

function checknum(number) {
    if (isNaN(number.value)) {
        errors = "<li>" + toTitleCase(number.id) + " must be a number!</li>";
        document.getElementById('error').innerHTML = errors;
    } else {
        document.getElementById('error').innerHTML = "";
        errors = "";
    }
};

function printTime() {
    let oTime = timetosecs();
    return secstotime(oTime);
}

function toTitleCase(str) {
    return str.replace(/\w\S*/g, function(txt) {
        return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
    });
};

function validate() {
    let elems = document.getElementsByClassName('required');
    let allgood = true;
    let emptytimes = false;
    let emptydistance = false;

    //Loop through all elements with this class
    for (var i = 0; i < elems.length; i++) {
        if (!elems[i].value || !elems[i].value.length) {
            elems[i].className += " error";
            allgood = false;
        }
    }

    /*
    let times = document.getElementsByClassName('time');
    if (!times[0].value && !times[1].value && !times[2].value && !times[0].value.length && !times[1].value.length && !times[2].value.length) {
        elems[i].className += " error";
        emptytimes = true;
    }

     */
    /*
    let distance = document.getElementById('distance')
    if (!distance.value) {
        emptydistance = true;
    }

    if (emptydistance && emptytimes) {
        allgood = false;
    }

     */
    //If any element did not meet the requirements, prevent it from being submitted and display an alert
    if (!allgood) {
        document.getElementById("pangbutton").disabled = true;
    } else {
        document.getElementById("pangbutton").disabled = false;
    }
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
                city: "Duckburg"
            },
            function(data, status) {
                if(status != "success"){
                    alert("Something went wrong!");
                }
            });
    });
});