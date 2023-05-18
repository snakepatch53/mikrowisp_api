const $citaform_cliente = document.querySelector("#citaform-cliente");
const $citaform_cita = document.querySelector("#citaform-cita");
const $btn_send = document.querySelector("#btn-send");
const $calendar_container = document.querySelector("#calendar-container");
const $congratulations = document.querySelector("#congratulations");
const $search_container = document.querySelector("#search-container");

// CALENDAR PLUGIN
const $picker = document.querySelector(".flatpickr").flatpickr({
    enable: [
        {
            from: new Date(),
            to: new Date().fp_incr(365),
        },
    ],
    inline: true,
    onChange: function (selectedDates, dateStr, instance) {
        $citaform_cita["user_id"].disabled = false;
    },
});

$citaform_cita["user_id"].onchange = async function (evt) {
    user_id = evt.target.value;
    if (evt.target.value == "") {
        return ($citaform_cita["hora_id"].disabled = true);
    }
    const dateStr = $picker.selectedDates[0].toISOString().split("T")[0];
    const horas = await selectHoras();
    if (!horas) return;
    const citas = (await selectCitas(dateStr)) || [];
    const filter_horas = horas.filter((hora) => {
        return citas.find((cita) => cita["hora_id"] == hora["hora_id"] && cita["user_id"] == user_id) == undefined;
    });

    $html_horas = `<option value="">Seleccione una opcion</option>`;
    filter_horas.forEach((hora) => ($html_horas += `<option value="${hora["hora_id"]}">${hora["hora_hora"]}</option>`));
    $citaform_cita["hora_id"].innerHTML = $html_horas;
    $citaform_cita["hora_id"].disabled = false;
};

function main() {
    disableFormCita(true);
    $citaform_cita["hora_id"].disabled = true;
    $citaform_cita["user_id"].disabled = true;
    // confetti
    var confettiSettings = { target: "canvas-confetti" };
    var confetti = new ConfettiGenerator(confettiSettings);
    confetti.render();
}

// EVENTOS
$citaform_cliente["cliente_cedula"].onkeyup = async function (evt) {
    var value = evt.target.value;
    if (!isCedula(value)) {
        disableFormCita(true);
        $citaform_cliente.classList.remove("show");
        if (value.length >= 10) setFieldError($search_container, true);
        return;
    }
    setFieldError($search_container, false);
    const cliente = await selectClient(value);
    if (!cliente) return clearFormCliente();
    showFormCliente(cliente);
};

$btn_send.onclick = async function (evt) {
    evt.preventDefault();
    if ($citaform_cliente["cliente_nombre"].value == "") setFieldError($citaform_cliente["cliente_nombre"], true);
    if ($citaform_cliente["cliente_celular"].value == "") setFieldError($citaform_cliente["cliente_celular"], true);
    if ($citaform_cliente["cliente_email"].value == "") setFieldError($citaform_cliente["cliente_email"], true);
    if ($citaform_cliente["cliente_direccion"].value == "") setFieldError($citaform_cliente["cliente_direccion"], true);
    if ($citaform_cita["hora_id"].value == "") {
        setFieldError($calendar_container, true);
        setFieldError($citaform_cita["hora_id"], true);
    }
    if ($citaform_cita["user_id"].value == "") setFieldError($citaform_cita["user_id"], true);
    if ($citaform_cita["servicio_id"].value == "") setFieldError($citaform_cita["servicio_id"], true);
    // validaciones
    if ($citaform_cliente["cliente_nombre"].value == "") return;
    if ($citaform_cliente["cliente_celular"].value == "") return;
    if ($citaform_cliente["cliente_email"].value == "") return;
    if ($citaform_cliente["cliente_direccion"].value == "") return;
    if ($citaform_cita["hora_id"].value == "") return;
    if ($citaform_cita["user_id"].value == "") return;
    if ($citaform_cita["servicio_id"].value == "") return;
    // crud cliente
    const formDataCliente = new FormData($citaform_cliente);
    if ($citaform_cliente["cliente_id"].value == "0") $citaform_cliente["cliente_id"].value = await insertCliente(formDataCliente);
    if ($citaform_cliente["cliente_id"].value != "0") await updateCliente(formDataCliente);
    // crud cita
    const date = $picker.selectedDates[0].toISOString().split("T")[0];
    const formDataCita = new FormData($citaform_cita);
    formDataCita.append("cita_fecha", date);
    formDataCita.append("cliente_id", $citaform_cliente["cliente_id"].value);
    const cita_id = await insertCita(formDataCita);
    $congratulations.classList.add("show");
    document.querySelector("#cita-date").innerText = moment(date).format("DD/MM/YYYY");
    document.querySelector("#cita-hour").innerText = $citaform_cita["hora_id"].selectedOptions[0].innerText;
    document.querySelector("#cita-doctor").innerText = $citaform_cita["user_id"].selectedOptions[0].innerText;
    document.querySelector("#print-a").href = `${http_domain}citas/print/${cita_id}`;
};

// UI FUNCTIONS
function clearFormCliente() {
    $citaform_cliente["cliente_id"].value = "0";
    $citaform_cliente["cliente_nombre"].value = "";
    $citaform_cliente["cliente_celular"].value = "";
    $citaform_cliente["cliente_email"].value = "";
    $citaform_cliente["cliente_direccion"].value = "";
    $citaform_cliente.classList.add("show");
    disableFormCita(false);
}

function showFormCliente(cliente) {
    $citaform_cliente.classList.add("show");
    $citaform_cliente["cliente_id"].value = cliente["cliente_id"];
    $citaform_cliente["cliente_nombre"].value = cliente["cliente_nombre"];
    $citaform_cliente["cliente_celular"].value = cliente["cliente_celular"];
    $citaform_cliente["cliente_email"].value = cliente["cliente_email"];
    $citaform_cliente["cliente_direccion"].value = cliente["cliente_direccion"];
    disableFormCita(false);
}

function disableFormCita(bool) {
    $btn_send.disabled = bool;
    if (bool) {
        $calendar_container.classList.add("disabled");
    } else {
        $calendar_container.classList.remove("disabled");
    }
    // $citaform_cita["user_id"].disabled = bool;
    $citaform_cita["servicio_id"].disabled = bool;
}

function setFieldError(field, bool) {
    if (bool) {
        field.classList.add("is-invalid");
    } else {
        field.classList.remove("is-invalid");
    }
}

// DAO FUNCTIONS
async function selectClient(cedula) {
    return new Promise((resolve, reject) => {
        fetch_query(null, "cliente", "select").then((res) => {
            if (!res.response) return resolve(false);
            if (res.data.length == 0) return resolve(false);
            const cliente = res.data.find((cliente) => cliente["cliente_cedula"] == cedula);
            return resolve(cliente);
        });
    });
}

async function insertCliente(formData) {
    return new Promise((resolve, reject) => {
        fetch_query(formData, "cliente", "insert").then((res) => {
            if (!res.response) return resolve(false);
            return resolve(res.data);
        });
    });
}

async function updateCliente(formData) {
    return new Promise((resolve, reject) => {
        fetch_query(formData, "cliente", "update").then((res) => {
            if (!res.response) return resolve(false);
            return resolve(true);
        });
    });
}

async function selectCitas(fecha) {
    return new Promise((resolve, reject) => {
        fetch_query(null, "cita", "select").then((res) => {
            if (!res.response) return resolve(false);
            if (res.data.length == 0) return resolve(false);
            const citas = res.data.filter((cita) => cita["cita_fecha"] == fecha);
            return resolve(citas);
        });
    });
}

async function insertCita(formData) {
    return new Promise((resolve, reject) => {
        fetch_query(formData, "cita", "insert").then((res) => {
            if (!res.response) return resolve(false);
            return resolve(res.data);
        });
    });
}

async function selectHoras() {
    return new Promise((resolve, reject) => {
        fetch_query(null, "hora", "select").then((res) => {
            if (!res.response) return resolve(false);
            if (res.data.length == 0) return resolve(false);
            return resolve(res.data);
        });
    });
}

// EJECUCION MAIN
main();
