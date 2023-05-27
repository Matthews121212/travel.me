const form = document.getElementById("user-info-form");
const inputs = document.querySelectorAll(".needs-validation");
let fieldValues = new Array();
let genderValues = new Array();
let modifying = false;
let passwordMode = false;

function modifyUserInfo(cancel, password) {
    modifying = !cancel;
    passwordMode = password;
    let fieldIds = ["name", "surname", "email", "birthday", "phoneNumber"];
    for (let id of fieldIds) {
        elem = document.getElementById(id);
        cancel ? elem.value = fieldValues[id] : fieldValues[id] = elem.value;
        elem.parentElement.hidden = password && !cancel;
        elem.readOnly = cancel;
    }
    document.getElementById("gender").hidden = password && !cancel;
    let genderIds = ["femaleGender", "maleGender", "otherGender"];
    for (let id of genderIds) {
        elem = document.getElementById(id);
        cancel ? elem.checked = genderValues[id] : genderValues[id] = elem.checked;
        elem.disabled = cancel;
    }
    document.getElementById("password-change-message").hidden = true;
    document.getElementById("oldPassword").parentElement.hidden = !password || cancel;
    document.getElementById("newPassword").parentElement.hidden = !password || cancel;
    document.getElementById("confirmPassword").parentElement.hidden = !password || cancel;
    document.getElementById("modify-button").hidden = !cancel;
    document.getElementById("change-password-button").hidden = !cancel;
    document.getElementById("cancel-button").hidden = password || cancel;
    document.getElementById("cancel-password-change-button").hidden = !password || cancel;
    document.getElementById("save-button").hidden = cancel;
    Array.from(inputs).forEach(input => input.classList.remove("is-valid", "is-invalid"));
}

function saveModify() {
    if (validateForm())
        form.submit();
}

function checkValidity(input) {
    const isPasswordField = input.id === "oldPassword" || input.id === "newPassword" || input.id === "confirmPassword";
    if (passwordMode && isPasswordField && input.value === "")
        return false;
    else if (!isPasswordField && input.value === "")
        return false;
    return input.checkValidity();
}

function validateForm() {
    var valid = true;
    Array.from(inputs).forEach(input => {
        if(checkValidity(input)) {
            input.classList.add("is-valid");
            input.classList.remove("is-invalid");
        }
        else {
            valid = false;
            input.classList.add("is-invalid");
            input.classList.remove("is-valid");
        }
    });
    return valid;
}

Array.from(inputs).forEach(input => {
  input.addEventListener('blur', event => {
    if (!modifying)
        return;
    if(checkValidity(input)) {
        input.classList.add("is-valid");
        input.classList.remove("is-invalid");
    }
    else {
        input.classList.add("is-invalid");
        input.classList.remove("is-valid");
    }
  }, false)
});