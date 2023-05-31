const form = document.getElementById("register-form");
const inputs = document.querySelectorAll(".needs-validation");
let invalidFeedback = document.getElementById("email").parentElement.querySelector(".invalid-feedback");

function submitForm() {
    validateForm(function (valid) {
        if (valid)
            form.submit();
    });
}

function checkValidity(input, callback) {
    if (input.value === "")
        return callback(false);
    let regex = /^./;
    switch (input.id) {
        case "name":
        case "surname":
            regex = /^[\w'\-,.][^0-9_!¡?÷?¿/\\+=@#$%ˆ&*(){}|~<>;:[\]]{2,}$/;
            break;
        case "email":
            if (!input.checkValidity()) {
                return callback(false);
            }
            $.ajax({
                url: "register_ajax.php",
                method: "POST",
                data: {
                    email: input.value
                },
                success: function(response) {
                    invalidFeedback.innerHTML = "This email is already in use";
                    callback(response);
                },
            });
            return;
        case "termsAndConditions":
            return callback(input.checked);
        case "password":
            return callback(input.value.length >= 8);
        case "confirmPassword":
            return callback(input.value === document.getElementById("password").value);
        case "phoneNumber":
            regex = /\+?\d{1,4}?[-.\s]?\(?\d{1,3}?\)?[-.\s]?\d{1,4}[-.\s]?\d{1,4}[-.\s]?\d{1,9}/;
            break;
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
    input.classList.remove("is-valid", "is-invalid");
    invalidFeedback.innerHTML = "Please provide a valid email";
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