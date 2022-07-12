if (location.href == "http://localhost/webApplicationChat/users/login") {
  const form = document.querySelector(".login form");
  const continueBtn = form.querySelector(".button input");
  const errorText = form.querySelector(".error-text");

  continueBtn.addEventListener("click", (e) => {
    e.preventDefault();

    const email = form.querySelector(".email").value;
    const pass = form.querySelector(".password").value;

    if (email == "" || pass == "") {
      errorText.style.display = "block";
      errorText.textContent = "All input fields are required!";
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
    const specialChars = /^[0-9a-zA-Z]*$/;
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
