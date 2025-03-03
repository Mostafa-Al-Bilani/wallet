document.addEventListener("DOMContentLoaded", function () {
    const loginForm = document.getElementById("signupForm");
  
    loginForm.addEventListener("submit", async function (event) {
      event.preventDefault();
  
      // Get input values
      const name = document.getElementById("name").value;
      const email = document.getElementById("email").value;
      const phoneNumber = document.getElementById("phoneNumber").value;
      const dob = document.getElementById("dob").value;
      const password = document.getElementById("password").value;
  
      try {
        // Send request with Axios
        const response = await axios.post(
          "http://localhost/wallet/wallet-server/user/v1/signup.php",
          {name, email, phoneNumber, dob, password },
          { headers: { "Content-Type": "application/json" } }
        );
  
        if (response.data.status === "success") {
          window.location.href = "./";  
        }
        else{
          alert(response.data.message)
        }
      } catch (error) {
        console.error(error);
        alert(
          "Error: " + (error.response?.data?.message || "Something went wrong")
        );
      }
    });
  });
  