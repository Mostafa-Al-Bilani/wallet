const backendUrl = "http://localhost/wallet/wallet-server/user/v1";
function toast(message)
{
    document.getElementById("toast").innerHTML = message;
      const toastElement = document.getElementById("toast");

      toastElement.classList.add("visible");

      setTimeout(() => {
        toastElement.classList.remove("visible");
      }, 2000);
}