document.addEventListener("DOMContentLoaded", function () {
    const buttons = document.querySelectorAll(".open-modal");
    const closeButtons =  document.querySelectorAll(".close-modal");

    buttons.forEach(button => {
        button.addEventListener("click", () => {
            const targetId = button.getAttribute("id").split("-")[1];
            // show the selected modal
            document.getElementById("modal-" + targetId).classList.add("active");
        });
    });
    closeButtons.forEach(button => {
        button.addEventListener("click", (event) => {
            const grandparentElement = event.target.parentElement.parentElement;
            grandparentElement.classList.remove("active");
        });
    });
});