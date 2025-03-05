document.addEventListener("DOMContentLoaded", function () {
  const token = localStorage.getItem("token");
  const loginForm = document.getElementById("profileForm");

  document.getElementById("name").value = localStorage.getItem("name");
  document.getElementById("email").value = localStorage.getItem("email");
  document.getElementById("phoneNumber").value = localStorage.getItem("phoneNumber");
  document.getElementById("dob").value = localStorage.getItem("dob");

  loginForm.addEventListener("submit", async function (event) {
    event.preventDefault();

    // Get input values
    const name = document.getElementById("name").value;
    const email = document.getElementById("email").value;
    const phoneNumber = document.getElementById("phoneNumber").value;
    const dob = document.getElementById("dob").value;

    try {
      // Send request with Axios
      const response = await axios.post(
        "http://localhost/wallet/wallet-server/user/v1/update.php",
        { name, email, phoneNumber, dob },
        {
          headers: {
            "Content-Type": "application/json",
            Authorization: `Bearer ${token}`,
          },
        }
      );

      if (response.data.status === "success") {
        alert("success");
        localStorage.setItem("name", name);
          localStorage.setItem("dob", dob);
          localStorage.setItem("email", email);
          localStorage.setItem("phoneNumber", phoneNumber);
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
