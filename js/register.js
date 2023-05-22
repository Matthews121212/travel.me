function validateForm(event) {
    if (!document.getElementById("termsAndConditions").checked) {
        document.getElementById("register-form").insertAdjacentHTML("afterend", "teadsdasdsa");
        event.preventDefault();
    }
}