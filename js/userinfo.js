function modifyUserInfo() {
    values = new Array();
    for (let elem of document.getElementsByClassName("user-info")) {
        values[elem.id] = elem.value;
        elem.removeAttribute("readonly");
        elem.classList.remove("form-control-plaintext");
        elem.classList.add("form-control");
    }
    switch (document.getElementById("genderReadOnly").value) {
        case "female":
            document.getElementById("femaleGender").checked = true;
            break;
        case "male":
            document.getElementById("maleGender").checked = true;
            break;
        case "other":
            document.getElementById("otherGender").checked = true;
            break;
    }
    for (let elem of document.getElementsByClassName("gender")) {
        elem.hidden = false;
    }
    document.getElementById("genderDiv").classList.remove("row");
    document.getElementById("genderReadOnly").hidden = true;
    document.getElementById("modify-button").hidden = true;
    document.getElementById("cancel-button").hidden = false;
    document.getElementById("save-button").hidden = false;
}

function cancelModify() {
    for (let elem of document.getElementsByClassName("user-info")) {
        elem.value = values[elem.id];
        elem.readOnly = true;
        elem.classList.add("form-control-plaintext");
        elem.classList.remove("form-control");
    }
    for (let elem of document.getElementsByClassName("gender")) {
        elem.hidden = true;
    }
    document.getElementById("genderDiv").classList.add("row");
    document.getElementById("genderReadOnly").hidden = false;
    document.getElementById("modify-button").hidden = false;
    document.getElementById("cancel-button").hidden = true;
    document.getElementById("save-button").hidden = true;
}

function saveModify() {
    document.getElementById("modify-form").submit();
}