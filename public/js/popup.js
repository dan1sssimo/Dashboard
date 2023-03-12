//burger popup
const hamb = document.querySelector("#hamb");
const close = document.querySelector("#hambClose")
const popupBurger = document.querySelector("#popupBurger");
const main = document.querySelector("#main");

hamb.addEventListener("click", hambClose);
close.addEventListener("click", hambHandler);

function hambHandler(e) {
    e.preventDefault();
    popupBurger.classList.toggle("open");
    let openClass = document.querySelector(".open")
    // console.log('Hello!');
}

function hambClose(e) {
    e.preventDefault();
    popupBurger.classList.remove("open");
}
