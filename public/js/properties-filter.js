$('.open_filter').on('click', function(event) {
    event.preventDefault();

    const box = $(".form_advanced");
    const buttonFilter = $(this);

    if (box.css("display") !== "none") {
        buttonFilter.text("Filtro Avançado ↓");
    } else {
        buttonFilter.text("✗ Fechar");
    }

    box.slideToggle();
});

let goal = "";
let category = "";
let type = "";
let city = "";
let bedroom = "";
let suite = "";
let bathroom = "";
let garage = "";
let base_price = "";
let limit_price = "";

const goalSelect = $("#goal");
const categorySelect = $("#category");
const typeSelect = $("#type");
const citySelect = $("#city");
const bedroomSelect = $("#bedroom");
const suiteSelect = $("#suite");
const bathroomSelect = $("#bathroom");
const garageSelect = $("#garage");
const basePriceSelect = $("#base_price");
const limitPriceSelect = $("#limit_price");

goalSelect.val("");
categorySelect.val("");
typeSelect.val("");
citySelect.val("");
bedroomSelect.val("");
suiteSelect.val("");
bathroomSelect.val("");
garageSelect.val("");
basePriceSelect.val("");
limitPriceSelect.val("");

function getData(url, field) {
    $.ajax({
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        data: {
            goal,
            category,
            type,
            city,
            bedroom,
            suite,
            bathroom,
            garage,
            base_price,
            limit_price,
        },
        url,
        success: function (res) {
            if (res) {
                $(`#${field}`).children().remove();
                $(`#${field}`).append(
                    `<option value="" disabled selected>Selecione</option>`
                );

                res.forEach((element) => {
                    if (element !== null) {
                        $(`#${field}`).append(
                            `<option value="${element}">${element}</option>`
                        );
                    } else {
                        $(`#${field}`).append(
                            `<option value="">Indiferente</option>`
                        );
                    }
                });
            }
        },
    });
}

goalSelect.on("change", function () {
    goal = $(this).val();

    categorySelect.val("");
    category = "";
    typeSelect.val("");
    type = "";
    citySelect.val("");
    city = "";
    bedroomSelect.val("");
    bedroom = "";
    suiteSelect.val("");
    suite = "";
    bathroomSelect.val("");
    bathroom = "";
    garageSelect.val("");
    garage = "";
    basePriceSelect.val("");
    base_price = "";
    limitPriceSelect.val("");
    limit_price = "";

    getData($(this).data("url"), "category");
});

categorySelect.on("change", function () {
    category = $(this).val();

    typeSelect.val("");
    type = "";
    citySelect.val("");
    city = "";
    bedroomSelect.val("");
    bedroom = "";
    suiteSelect.val("");
    suite = "";
    bathroomSelect.val("");
    bathroom = "";
    garageSelect.val("");
    garage = "";
    basePriceSelect.val("");
    base_price = "";
    limitPriceSelect.val("");
    limit_price = "";

    getData($(this).data("url"), "type");
});

typeSelect.on("change", function () {
    type = $(this).val();

    citySelect.val("");
    city = "";
    bedroomSelect.val("");
    bedroom = "";
    suiteSelect.val("");
    suite = "";
    bathroomSelect.val("");
    bathroom = "";
    garageSelect.val("");
    garage = "";
    basePriceSelect.val("");
    base_price = "";
    limitPriceSelect.val("");
    limit_price = "";

    getData($(this).data("url"), "city");
});

citySelect.on("change", function () {
    city = $(this).val();

    bedroomSelect.val("");
    bedroom = "";
    suiteSelect.val("");
    suite = "";
    bathroomSelect.val("");
    bathroom = "";
    garageSelect.val("");
    garage = "";
    basePriceSelect.val("");
    base_price = "";
    limitPriceSelect.val("");
    limit_price = "";

    getData($(this).data("url"), "bedroom");
});

bedroomSelect.on("change", function () {
    bedroom = $(this).val();

    suiteSelect.val("");
    suite = "";
    bathroomSelect.val("");
    bathroom = "";
    garageSelect.val("");
    garage = "";
    basePriceSelect.val("");
    base_price = "";
    limitPriceSelect.val("");
    limit_price = "";

    getData($(this).data("url"), "suite");
});

suiteSelect.on("change", function () {
    suite = $(this).val();

    bathroomSelect.val("");
    bathroom = "";
    garageSelect.val("");
    garage = "";
    basePriceSelect.val("");
    base_price = "";
    limitPriceSelect.val("");
    limit_price = "";

    getData($(this).data("url"), "bathroom");
});

bathroomSelect.on("change", function () {
    bathroom = $(this).val();

    garageSelect.val("");
    garage = "";
    basePriceSelect.val("");
    base_price = "";
    limitPriceSelect.val("");
    limit_price = "";

    getData($(this).data("url"), "garage");
});

garageSelect.on("change", function () {
    garage = $(this).val();

    basePriceSelect.val("");
    base_price = "";
    limitPriceSelect.val("");
    limit_price = "";

    getData($(this).data("url"), "base_price");
});

basePriceSelect.on("change", function () {
    base_price = $(this).val();

    limitPriceSelect.val("");
    limit_price = "";

    getData($(this).data("url"), "limit_price");
});

$("form").submit(function (e) {
    $.ajax({
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: $(this).attr("action"),
        data: {
            goal,
            category,
            type,
            city,
            bedroom,
            suite,
            bathroom,
            garage,
            base_price,
            limit_price,
        },
    });
});
