document.addEventListener("DOMContentLoaded", function () {
    const token = localStorage.getItem("token");
    const withdrawForm = document.getElementById("withdrawForm");
  
    withdrawForm.addEventListener("submit", async function (event) {
      event.preventDefault();
  
      // Get input values
      const amount = document.getElementById("withdraw-amount").value;
  
      try {
        // Send request with Axios
        const response = await axios.post(
          "http://localhost/wallet/wallet-server/user/v1/withdraw.php",
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
          <td>withdraw</td>
          <td>${formattedTime}</td>
          </tr>`;
          document.getElementById("transactions-body").innerHTML += html;
          document.getElementById("modal-withdraw").classList.remove("active");
        } else {
          alert(response.data.message);
        }
      } catch (error) {
        console.error(error);
        alert(
          "Error: " + (error.response?.data?.message || "Something went wrong")
        );
      }
    });
  });
  
