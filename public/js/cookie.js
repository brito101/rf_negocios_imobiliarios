const cookieButton=document.querySelectorAll("#cookieConsent [data-action]");cookieButton&&cookieButton.forEach((e=>{e.addEventListener("click",(t=>{t.preventDefault(),fetch(e.dataset.action,{headers:{"X-CSRF-TOKEN":document.querySelector("meta[name=csrf-token]").content},method:"POST",body:new URLSearchParams({cookie:e.dataset.cookie})}).then((e=>e.json())).then((e=>{$("#cookieConsent").fadeOut(),e.gtmHead&&document.querySelector("head").insertAdjacentHTML("beforeend",e.gtmHead),e.gtmBody&&document.querySelector("body").insertAdjacentHTML("afterbegin",e.gtmBody)}))}))}));
