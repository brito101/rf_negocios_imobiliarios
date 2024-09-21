let timer;
const property = $("#property-images").data("id");

function updateAlbumOrder(old_position, current_position) {
    console.log(old_position, current_position);
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        type: "POST",
        url: $("#property-images").data("url"),
        data: {
            property,
            old_position,
            current_position,
        },
        success: function (res) {
            client = null;
            step = null;
        },
    });
}

// items functions
function dragStart(e) {
    e.currentTarget.classList.add("dragging");
}

function dragEnd(e) {
    e.currentTarget.classList.remove("dragging");
}

// areas functions
function dragOver(e) {
    let dragItem = document.querySelector(".draggable-item.dragging");

    let old_position = dragItem.dataset.order;
    let current_position = e.currentTarget.dataset.position;

    if (
        old_position != undefined &&
        current_position != undefined &&
        old_position !== current_position
    ) {
        e.currentTarget.appendChild(dragItem);

        if (timer) clearTimeout(timer);
        timer = setTimeout(() => {
            let oldDiv = $(`.draggable-area[data-position=${old_position}]`);
            let image_change = $(
                `.draggable-item[data-order=${current_position}]`
            );

            oldDiv.append(image_change);

            image_change.attr("data-order", old_position);
            dragItem.dataset.order = current_position;

            updateAlbumOrder(old_position, current_position);
            timer = null;
        }, 1);
    }
}

// Events
document.querySelectorAll(".draggable-item").forEach((item) => {
    item.addEventListener("dragstart", dragStart);
    item.addEventListener("dragend", dragEnd);
});

document.querySelectorAll(".draggable-area").forEach((area) => {
    area.addEventListener("dragover", dragOver);
    area.addEventListener("drop", dragOver);
});
