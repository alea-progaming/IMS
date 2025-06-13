document.addEventListener("DOMContentLoaded", function () {
  const toggleBtn = document.getElementById("toggleBtn");
  const sidebar = document.getElementById("sidebar");
  const dashboardContentContainer = document.getElementById(
    "dashboardContentContainer"
  );

  let isShrunk = false;

  toggleBtn.addEventListener("click", (event) => {
    event.preventDefault();
    isShrunk = !isShrunk;

    if (isShrunk) {
      sidebar.classList.add("shrink");
      sidebar.style.width = "10%";
      dashboardContentContainer.style.width = "90%";
    } else {
      sidebar.classList.remove("shrink");
      sidebar.style.width = "20%";
      dashboardContentContainer.style.width = "80%";
    }
  });
});
