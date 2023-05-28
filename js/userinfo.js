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
    validateForm(function (valid) {
        if (valid)
            form.submit();
    });
}

function checkValidity(input, callback) {
    const isPasswordField = input.id === "oldPassword" || input.id === "newPassword" || input.id === "confirmPassword";
    let regex = /^./;
    if (passwordMode) {
        if (!isPasswordField)
            return callback(true);
        if (input.value === "")
            return callback(false);
        if (input.id === "confirmPassword" && input.value !== document.getElementById("newPassword").value)
            return callback(false);
        if (input.id === "oldPassword") {
            $.ajax({
                url: "userinfo_ajax.php",
                method: "POST",
                data: {
                    password: input.value
                },
                success: function(response) {
                    callback(response);
                },
            });
            return;
        }
    }
    else {
        if (isPasswordField)
            return callback(true);
        if (input.value === "")
            return callback(false);
        if (input.id === "name" || input.id === "surname")
            regex = /^[\w'\-,.][^0-9_!¡?÷?¿/\\+=@#$%ˆ&*(){}|~<>;:[\]]{2,}$/;
        else if (input.id === "phoneNumber")
            regex = /\+?\d{1,4}?[-.\s]?\(?\d{1,3}?\)?[-.\s]?\d{1,4}[-.\s]?\d{1,4}[-.\s]?\d{1,9}/;
    }
    callback(regex.test(input.value) && input.checkValidity());
}

function validateForm(callback) {
    let valid = true;

    const promises = [];
    Array.from(inputs).forEach(input => {
        const promise = new Promise(function(resolve) {
            checkValidity(input, function(result) {
                if(result) {
                    input.classList.remove("is-invalid");
                    input.classList.add("is-valid");
                }
                else {
                    valid = false;
                    input.classList.remove("is-valid");
                    input.classList.add("is-invalid");
                }
                resolve();
            });
        });

        promises.push(promise);
    });
    
    Promise.all(promises).then(function() {
        callback(valid);
    });
}

Array.from(inputs).forEach(input => {
  input.addEventListener('blur', () => {
    if (!modifying)
        return;
    checkValidity(input, function(result) {
        if(result) {
            input.classList.remove("is-invalid");
            input.classList.add("is-valid");
        }
        else {
            input.classList.remove("is-valid");
            input.classList.add("is-invalid");
        }
    });
  }, false)
});