function add() {
    actualrecipient = document.getElementById('recipient');
    result = document.getElementById('message_recipients');
    selec = document.getElementById("new_recipient");
    val = selec.value;
    rep_name = selec.options[selec.selectedIndex].text;

    valores = val.split('####');
    if (valores.length > 1) {
        newRecipient = valores[1];
        newid = valores[0];
    } else {
        newRecipient = rep_name;
        newid = val;
    }


    if (result.value == "") {
        result.value = newid;
    } else {
        result.value += "," + newid;
    }

    flag = true;
    arr = actualrecipient.placeholder.split(",");
    for (ele of arr) {
        if (ele == newRecipient) {
            flag = false;
        }
    }
    if (newRecipient != "" && flag) {
        if (actualrecipient.placeholder == "Recipients") {
            actualrecipient.placeholder = newRecipient;
        } else {
            actualrecipient.placeholder += "," + newRecipient;
        }
    }
}

function clearRecipient() {
    actualrecipient = document.getElementById('recipient');
    actualrecipient.placeholder = "Recipients";
    result = document.getElementById('message_id');
    result.value = "";
}

function clearMember() {
    actualrecipient = document.getElementById('member');
    actualrecipient.placeholder = "Members";
    result = document.getElementById('result');
    result.value = "";
}


function addMember() {
    member = document.getElementById("new_member").value;
    actualrecipient = document.getElementById('member');
    result = document.getElementById('result');


    flag = true;
    arr = actualrecipient.placeholder.split(",");
    for (ele of arr) {
        if (ele == member) {
            flag = false;
        }
    }
    if (member != "" && flag) {
        if (actualrecipient.placeholder == "Members") {
            actualrecipient.placeholder = member;
        } else {
            actualrecipient.placeholder += "," + member;
        }
    }

    result.value = actualrecipient.placeholder;
}