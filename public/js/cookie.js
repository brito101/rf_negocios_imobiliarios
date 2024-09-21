const cookieButton = document.querySelectorAll("#cookieConsent [data-action]");

if (cookieButton) {
    cookieButton.forEach((el) => {
        el.addEventListener("click", (e) => {
            e.preventDefault();
            fetch(el.dataset.action, {
                headers: {
                    "X-CSRF-TOKEN": document.querySelector(
                        "meta[name=csrf-token]"
                    ).content,
                },
                method: "POST",
                body: new URLSearchParams({
                    cookie: el.dataset.cookie,
                }),
            })
                .then((res) => res.json())
                .then((res) => {
                    $("#cookieConsent").fadeOut();
                    if (res.gtmHead) {
                        document
                            .querySelector("head")
                            .insertAdjacentHTML("beforeend", res.gtmHead);
                    }
                    if (res.gtmBody) {
                        document
                            .querySelector("body")
                            .insertAdjacentHTML("afterbegin", res.gtmBody);
                    }
                });
        });
    });
}
