const $form = document.querySelector("#form");
const $congratulations = document.querySelector("#congratulations");

$form.addEventListener("submit", handleSubmit);

var confettiSettings = { target: "confetti" };
var confetti = new ConfettiGenerator(confettiSettings);
confetti.render();

async function handleSubmit(event) {
    event.preventDefault();
    console.log($form["mensaje_nombre"].value);
    if ($form["mensaje_nombre"].value === "") setErrorFor($form["mensaje_nombre"], "El nombre es obligatorio");
    if ($form["mensaje_celular"].value === "") setErrorFor($form["mensaje_celular"], "El email es obligatorio");
    if ($form["mensaje_email"].value === "") setErrorFor($form["mensaje_email"], "El asunto es obligatorio");
    if ($form["mensaje_mensaje"].value === "") setErrorFor($form["mensaje_mensaje"], "El mensaje es obligatorio");
    if ($form["mensaje_nombre"].value === "") return;
    if ($form["mensaje_celular"].value === "") return;
    if ($form["mensaje_email"].value === "") return;
    if ($form["mensaje_mensaje"].value === "") return;

    const formData = new FormData($form);
    const data = await insertMensaje(formData);
    if (!data) return;

    $congratulations.classList.add("show");

    // const response = await fetch(this.action, {
    //     method: this.method,
    //     body: form,
    //     headers: {
    //         Accept: "application/json",
    //     },
    // });
    // if (response.ok) {
    //     this.reset();
    //     Swal.fire("Gracias!", "Mensaje enviado", "success");
    // }
}

function setErrorFor($input, message, bool) {
    const $msgError = $input.parentElement.querySelector(".error");
    if (bool) {
        $input.classList.remove("error");
        $msgError.innerText = "";
        return;
    }
    $input.classList.add("error");
    $msgError.innerText = message;
}

function insertMensaje(formData) {
    return new Promise((resolve, reject) => {
        fetch_query(formData, "mensaje", "insert").then((res) => {
            console.log(res);
            if (!res.response) return resolve(false);
            return resolve(res.data);
        });
    });
}
