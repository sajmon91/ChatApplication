if (location.href == "http://localhost/webApplicationChat/users/register") {
  const form = document.querySelector(".signup form");
  const continueBtn = form.querySelector(".button input");
  const errorText = form.querySelector(".error-text");

  continueBtn.addEventListener("click", (e) => {
    e.preventDefault();

    const username = form.querySelector(".username").value;
    const email = form.querySelector(".email").value;
    const pass = form.querySelector(".pass").value;

    if (username == "" || email == "" || pass == "") {
      errorText.style.display = "block";
      errorText.textContent = "All input fields are required!";
      return;
    }

    //validate username
    const specialChars = /^[0-9a-zA-Z]*$/;
    if (!username.match(specialChars)) {
      errorText.style.display = "block";
      errorText.textContent = "Username must be only letters and numbers";
      return;
    }

    //validate email
    const mailFormat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    if (!email.match(mailFormat)) {
      errorText.style.display = "block";
      errorText.textContent = "Invalid email";
      return;
    }

    //validate password
    if (!pass.match(specialChars)) {
      errorText.style.display = "block";
      errorText.textContent = "Password must be only letters and numbers";
      return;
    }
    if (pass.length < 3 || pass.length > 20) {
      errorText.style.display = "block";
      errorText.textContent = "Password must be between 3 and 20 characters";
      return;
    }

    form.requestSubmit();
  });
}
