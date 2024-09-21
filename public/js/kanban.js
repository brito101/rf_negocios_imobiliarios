function countItems() {
    $(".draggable-area").each(function () {
        $(this)
            .parent()
            .find(".count")
            .text($(this).find(".draggable-item").length);
    });
}

countItems();

let client = null;
let step = null;
let timer;

function updateKanban() {
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        type: "POST",
        url: $("#kanban").data("action"),
        data: {
            client,
            step,
        },
        success: function (res) {
            client = null;
            step = null;
            countItems();
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
    e.currentTarget.appendChild(dragItem);
    if (e.target.dataset.step !== undefined) {
        client = dragItem.dataset.client;
        step = e.target.dataset.step;
        if (client && step) {
            if (timer) clearTimeout(timer);
            timer = setTimeout(() => {
                updateKanban();
                timer = null;
            }, 500);
        }
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
