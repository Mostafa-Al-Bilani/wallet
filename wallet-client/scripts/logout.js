document.addEventListener("DOMContentLoaded", function () {
    const button = document.getElementById("logout");
        button.addEventListener("click", () => {
            localStorage.removeItem("token");
            window.location.href = "./";

        });
   
});