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
    let second = document.getElementById('seconds');
    let minute = document.getElementById('minutes');
    if (second.value > 60 || minute.value > 60) {
    	allgood = false;
    }
    let times = document.getElementsByClassName('time');
    if (!times[0].value && !times[1].value && !times[2].value && !times[0].value.length && !times[1].value.length && !times[2].value.length) {
        emptytimes = true;
    }

    let distance = document.getElementById('distance');
    if (!distance.value) {
        emptydistance = true;
    }

    if (emptydistance && emptytimes) {
        allgood = false;
    }

     
    //If any element did not meet the requirements, prevent it from being submitted and display an alert
    if (!allgood) {
        document.getElementById("pangbutton").disabled = true;
    } else {
        document.getElementById("pangbutton").disabled = false;
    }
};

function validateRange(inputField, max) {
    if(inputField.value > max){
        inputField.style.border = "3px solid #b71234";
    } else{
         inputField.style.border = "";
    }
};