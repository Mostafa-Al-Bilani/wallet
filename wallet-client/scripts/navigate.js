document.addEventListener("DOMContentLoaded", function () {
    const buttons = document.querySelectorAll(".navigate");
    const pages = document.querySelectorAll(".page");

    buttons.forEach(button => {
        button.addEventListener("click", () => {
            const targetId = button.getAttribute("id");

            // hide all pages
            pages.forEach(page => page.classList.add("hidden"));

            // show the selected page
            document.getElementById("page-" + targetId).classList.remove("hidden");

            buttons.forEach(btn => btn.classList.remove("clicked"));
            button.classList.add("clicked");
        });
    });
});