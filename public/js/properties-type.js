const prevId = $("#category_id").select2().val();
let types = $("#type_id option[data-category]");

function changeType(id) {
    types.prop("disabled", true);
    $(`#type_id option[data-category=${id}]`).prop("disabled", false);
    $("#type_id").val("").trigger("change");
}

changeType(prevId);

$("#category_id").on("select2:select", function (e) {
    let id = e.params.data.id;
    changeType(id);
});
