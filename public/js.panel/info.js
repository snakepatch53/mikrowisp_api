const $form = document.getElementById("element-form");
const $btn_submit = document.getElementById("btn-submit");
const $inputs = document.querySelectorAll("input, textarea");

async function main() {
    $form.addEventListener(
        "submit",
        function (event) {
            event.preventDefault();
            if (handleFunction.getMode() == "false") {
                handleFunction.changeMode(true);
                return;
            }
            if (!$form.checkValidity()) {
                event.stopPropagation();
            }
            if ($form.checkValidity()) {
                crudFunction.update();
            }

            $form.classList.add("was-validated");
        },
        false
    );
    handleFunction.updateMode();
    await crudFunction.select();
}

//functions
const handleFunction = {
    getMode: function () {
        const mode = $form.getAttribute("editMode");
        return mode;
    },
    changeMode: function (mode) {
        $form.setAttribute("editMode", mode);
        this.updateMode();
    },
    updateMode: function () {
        const mode = this.getMode();
        if (mode == "false") {
            $btn_submit.classList.remove("btn-primary");
            $btn_submit.classList.add("btn-info");
            $btn_submit.innerText = "Editar";
            $inputs.forEach((element) => (element.disabled = true));
        } else {
            $btn_submit.classList.remove("btn-info");
            $btn_submit.classList.add("btn-primary");
            $btn_submit.innerText = "Guardar";
            $inputs.forEach((element) => (element.disabled = false));
            $inputs[0].focus();
        }
    },
};

const crudFunction = {
    select: async function () {
        await fetch_query(null, "info", "select").then((res) => {
            console.log(res);
            uiFunction.refresh(res.data);
        });
    },
    update: function () {
        const formData = new FormData($form);
        // print formdata
        fetch_query(formData, "info", "update").then((res) => {
            console.log(res);
            uiFunction.refresh(res);
            handleFunction.changeMode(false);
        });
    },
};

const uiFunction = {
    refresh: function (data) {
        for (let i in data) {
            if (typeof $form[i] == "undefined" || i == "info_logo" || i == "info_icon") continue;
            $form[i].value = data[i];
        }
    },
};

main();
