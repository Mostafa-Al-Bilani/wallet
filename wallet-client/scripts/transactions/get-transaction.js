async function getTransactions() {
  const token = localStorage.getItem("token");
  try {
    // Send request with Axios
    const response = await axios.get(
      `${backendUrl}/get-transactions.php"`,
      {
        headers: {
          "Content-Type": "application/json",
          Authorization: `Bearer ${token}`,
        },
      }
    );

    if (response.data.status === "success") {
      return response.data.transactions;
    } else {
      alert(response.data.message);
      return [];
    }
  } catch (error) {
    console.error(error);
    alert(
      "Error: " + (error.response?.data?.message || "Something went wrong")
    );
  }
}

document.addEventListener("DOMContentLoaded", async function () {
  const transactionsTableBody = document.getElementById("transactions-body");
  const transactions = await getTransactions();
  let html = "";
  for (i = 0; i < transactions.length; i++) {
    html += `<tr>
        <td>${transactions[i].amount}</td>
        <td>${transactions[i].description}</td>
        <td>${transactions[i].createdat}</td>
        </tr>`;
  }
  transactionsTableBody.innerHTML = html;
});