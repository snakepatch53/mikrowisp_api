const forms = document.querySelectorAll(".needs-validation");
const $form = document.getElementById("element-form");
const $element_table = document.getElementById("element-table");

// bootstrap instances
const bootstrap_modalform = new bootstrap.Modal(document.getElementById("element-modalform"), {
    keyboard: false,
});
const bootstrap_modalconfirm = new bootstrap.Modal(document.getElementById("element-modalconfirm"), {
    keyboard: false,
});

async function main() {
    await crudFunction.select();
    $form.addEventListener(
        "submit",
        function (event) {
            if (!$form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            if ($form.checkValidity()) {
                event.preventDefault();
                crudFunction.insertUpdate($form);
            }

            $form.classList.add("was-validated");
        },
        false
    );
}

//functions
const handleFunction = {
    new: function () {
        uiFunction.modalForm_clear();
        $form["cita_id"].value = 0;
        bootstrap_modalform.show();
    },
    edit: function ($register_id) {
        const register = uiFunction.database.find((el) => el["cita_id"] == $register_id);
        setValuesForm(register, $form);
        bootstrap_modalform.show();
    },
    delete: function (register_id) {
        $form["cita_id"].value = register_id;
        bootstrap_modalconfirm.show();
    },

    // gift functions
    giftTrButton: function (register_id) {
        $form_gift["cita_id"].value = register_id;
        uiFunction.refreshTableGift(register_id);
        element_modalgift.show();
    },
};

const crudFunction = {
    select: async function () {
        await fetch_query(new FormData($form), "cita", "select").then((res) => {
            if (res.response) {
                if (SESSION["user_tipo"] == "user") {
                    uiFunction.database = res.data;
                } else {
                    uiFunction.database = res.data.filter((el) => el["user_id"] == SESSION["user_id"]);
                }
                uiFunction.refreshTable();
            }
        });
    },
    insertUpdate: function (form) {
        const action = $form["cita_id"].value == 0 ? "insert" : "update";
        fetch_query(new FormData(form), "cita", action).then((res) => {
            uiFunction.modalForm_hide();
            this.select();
        });
    },
    delete: function () {
        fetch_query(new FormData($form), "cita", "delete").then((res) => {
            uiFunction.modalForm_hide();
            this.select();
            uiFunction.modalConfirm_hide();
        });
    },
};

const uiFunction = {
    database: [],
    giftDatabase: [],
    getTr: function ({ cita_id, cliente_nombre, user_nombre, user_foto, user_last, cita_fecha, hora_hora, servicio_nombre }) {
        // usar moment js para poner la fecha en formato letras
        const fecha = moment(cita_fecha).format("dddd, DD MMMM YYYY");
        const hora = moment(cita_fecha + " " + hora_hora).format("hh:mm a");
        return `
            <tr>
                <td class="d-none d-md-table-cell fw-bold">${cita_id}</td>
                <td class="text-center text-md-left">${cliente_nombre}</td>
                <td class="text-center text-md-left">${fecha} - ${hora}</td>
                <td class="d-none d-md-table-cell text-center text-md-left">
                    <img src="${http_domain}public/img.users/${user_foto}?last=${user_last}" class="rounded-circle" width="30" height="30" alt="${user_nombre}">
                    <span>${user_nombre}</span>
                </td>
                <td class="d-none d-md-table-cell text-center text-md-left">${servicio_nombre}</td>
                <td class="text-center">
                    <a class="btn btn-outline-info" href="${http_domain}citas/print/${cita_id}" target="_blank">
                        <i class="fa-solid fa-print"></i>
                    </a>
                    <button class="btn btn-outline-primary" onclick="handleFunction.edit(${cita_id})">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </button>
                    <button class="btn btn-outline-danger" onclick="handleFunction.delete(${cita_id})">
                        <i class="fa-solid fa-trash-can"></i>
                    </button>
                </td>
            </tr>
        `;
    },
    refreshTable: function () {
        let html = "";
        for (let item of this.database) {
            html += this.getTr(item);
        }
        $element_table.innerHTML = html;
    },
    modalForm_hide: function () {
        bootstrap_modalform.hide();
        this.modalForm_clear();
    },
    modalForm_clear: function () {
        $form.reset();
        $form.classList.remove("was-validated");
    },
    modalConfirm_hide: function () {
        bootstrap_modalconfirm.hide();
    },
};

main();
