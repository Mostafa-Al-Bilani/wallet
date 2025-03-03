document.addEventListener("DOMContentLoaded", () => {
    const isAuthenticated = localStorage.getItem("token");

    if (!isAuthenticated) {
        window.location.href = "./"; 
    }
});
