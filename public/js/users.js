if (location.href == "http://localhost/webApplicationChat/users") {
  const searchBar = document.querySelector(".search input");
  const searchIcon = document.querySelector(".search button");
  const usersList = document.querySelectorAll(".users-list a");

  searchIcon.addEventListener("click", () => {
    searchBar.classList.toggle("show");
    searchIcon.classList.toggle("active");
    searchBar.focus();
    if (searchBar.classList.contains("active")) {
      searchBar.value = "";
      searchBar.classList.remove("active");
    }
  });

  searchBar.addEventListener("keyup", (e) => {
    const q = e.target.value.toLowerCase();

    usersList.forEach((user) => {
      user
        .querySelector(".details span")
        .textContent.toLowerCase()
        .startsWith(q)
        ? (user.style.display = "block")
        : (user.style.display = "none");
    });
  });
}
