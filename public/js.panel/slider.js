const $form = document.getElementById("element-form");
const $element_gallery = document.getElementById("element-gallery");

// bootstrap instances
const bootstrap_modalconfirm = new bootstrap.Modal(document.getElementById("element-modalconfirm"), {
    keyboard: false,
});

async function main() {
    await crudFunction.select();
    $form["slider_imagen"].onchange = () => crudFunction.insert();
}

//functions
const handleFunction = {
    delete: function (slider_id) {
        $form.slider_id.value = slider_id;
        bootstrap_modalconfirm.show();
    },
};

const crudFunction = {
    select: async function () {
        await fetch_query(new FormData($form), "slider", "select").then((res) => {
            if (res.response == false) return;
            uiFunction.database = res.data;
            uiFunction.refreshTable();
        });
    },
    insert: function () {
        let formData = new FormData($form);
        formData.append("slider_titulo", "");
        fetch_query(formData, "slider", "insert").then((res) => {
            this.select();
        });
    },
    delete: function () {
        fetch_query(new FormData($form), "slider", "delete").then((res) => {
            uiFunction.modalForm_hide();
            this.select();
        });
    },
};

const uiFunction = {
    database: [],
    giftDatabase: [],
    getTrslider: function ({ slider_id, slider_imagen }) {
        return `
            <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <img src="${http_domain}public/img.slider/${slider_imagen}" class="card-img slider-img" alt="...">
                        <button class="btn btn-warning mt-2" style="width:100%" onclick="handleFunction.delete(${slider_id})">
                            <i class="fa-solid fa-trash"></i>
                            <span>Eliminar</span>
                        </button>
                    </div>
                </div>
            </div>
        `;
    },
    refreshTable: function () {
        let html = "";
        for (let slider of this.database) {
            html += this.getTrslider(slider);
        }
        $element_gallery.innerHTML = html;
    },
    modalForm_hide: function () {
        bootstrap_modalconfirm.hide();
    },
};

main();
