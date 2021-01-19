window.addEventListener("load", (root) => {
    const buttons = document.querySelectorAll("button");
    buttons.forEach(e => {
        e.classList.add("button", "is-primary", "mt-3");
    });
})