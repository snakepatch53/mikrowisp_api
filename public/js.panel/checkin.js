//variables
const forms = document.querySelectorAll(".needs-validation");
const register_form = document.getElementById("register-form");
const togglePassword = document.querySelector("#togglePassword");
const password = document.querySelector("#validationCustom09");

//main thread
(function () {
    "use strict";
    togglePassword.onclick = function () {
        const type = password.getAttribute("type") === "password" ? "text" : "password";
        password.setAttribute("type", type);
        this.innerHTML = type === "password" ? "<i class='fa fa-eye'></i>" : "<i class='fa fa-eye-slash'></i>";
    };

    // Loop over them and prevent submission
    Array.prototype.slice.call(forms).forEach(function (form) {
        for (const field of form.elements) {
            if (field.name == "usuario_cedula") {
                field.addEventListener("input", function handleInvalidField() {
                    if (!isCedula(this.value)) {
                        this.setCustomValidity("Ingrese cedula valida");
                    } else {
                        this.setCustomValidity("");
                    }
                });
            }
        }

        form.addEventListener(
            "submit",
            function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                if (form.checkValidity()) {
                    event.preventDefault();
                    const formData = new FormData(register_form);
                    const action = register_form.usuario_id.value == 0 ? "insert" : "update";
                    fetch_query(formData, "usuario", action).then((res) => {
                        location.href = root_url + (register_form.usuario_id.value == 0 ? "login" : "profile");
                    });
                }

                form.classList.add("was-validated");
            },
            false
        );
    });
})();
