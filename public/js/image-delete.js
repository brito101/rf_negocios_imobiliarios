$(".image-delete").on("click", function (e) {
    e.preventDefault();
    if (confirm("Confirma a exclusão desta imagem?") == true) {
        let image = e.target.dataset.id;
        let property = e.target.dataset.property;
        if (image && property) {
            $.ajax({
                type: "POST",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                url: e.target.dataset.action,
                data: {
                    property,
                    image,
                },
                success: function (res) {
                    if (res.message == "success") {
                        $("div").find(`[data-id='${image}']`).parent().parent().remove();
                    } else {
                        alert("Falha ao remover a imagem");
                    }
                },
            });
        }
    }
});
