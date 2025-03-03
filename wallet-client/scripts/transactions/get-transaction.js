async function getTransactions(){
    try {
        // Send request with Axios
        const response = await axios.get(
          "http://localhost/wallet/wallet-server/user/v1/get-transactions.php",
          { headers: { "Content-Type": "application/json" } }
        );
  
        if (response.data.status === "success") {
            return response.data.transactions;
        }
        else{
          alert(response.data.message)
          return [];
        }
      } catch (error) {
        console.error(error);
        alert(
          "Error: " + (error.response?.data?.message || "Something went wrong")
        );
      }
}

document.addEventListener("DOMContentLoaded", function () {
    const transactionsTableBody = document.getElementById("transactions-body");
    const transactions = getTransactions();
    let html = "";
    for(i = 0; i < transactions.length; i++)
    {
        html += `<tr>
        <td>${transactions[i].amount}</td>
        <td>${transactions[i].description}</td>
        <td>${transactions[i].createdat}</td>
        <td>${transactions[i].updated}</td>
        </tr>`;
    }
    transactionsTableBody.innerHTML = html;
    });
  