document.addEventListener("DOMContentLoaded", function () {
  const token = localStorage.getItem("token");
  const depositeForm = document.getElementById("depositForm");

  depositeForm.addEventListener("submit", async function (event) {
    event.preventDefault();

    // Get input values
    const amount = document.getElementById("deposite-amount").value;

    try {
      // Send request with Axios
      const response = await axios.post(
        `${backendUrl}/deposit.php`,
        { amount },
        {
          headers: {
            "Content-Type": "application/json",
            Authorization: `Bearer ${token}`,
          },
        }
      );

      if (response.data.status === "success") {
        const now = new Date();
        const formattedTime = now.toISOString().slice(0, 19).replace("T", " ");
        let html = `<tr>
        <td>${amount}</td>
        <td>deposit</td>
        <td>${formattedTime}</td>
        <td>${formattedTime}</td>
        </tr>`;
        document.getElementById("transactions-body").innerHTML += html;
        document.getElementById("modal-deposit").classList.remove("active");
      }
      toast(response.data.message);
    } catch (error) {
      toast("Error: " + (error.response?.data?.message || "Something went wrong"));
    }
  });
});
