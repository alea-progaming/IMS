// js/users.js
function script() {
  ((this.initialize = function () {
    this.registerEvents(); // this will hold the events that the current page will have
  }),
    (this.buildEditForm = function (user_id, first_name, last_name, email) {
      return `
      <form method="POST" class="appForm" id="updateUserForm">
        <div class="appFormDiv">
          <label for="fName">First Name</label>
          <input type="text" class="formInput" name="first_name" id="fName" value="${first_name}">
        </div>
        <div class="appFormDiv">
          <label for="lName">Last Name</label>
          <input type="text" class="formInput" name="last_name" id="lName" value="${last_name}">
        </div>
        <div class="appFormDiv">
          <label for="email">Email</label>
          <input type="text" class="formInput" name="email" id="email" value="${email}">
          <div class="">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </div>
        <input type="hidden" name="user_id" value="${user_id}">
      </form>
    `;
    }),
    (this.registerEvents = function () {
      document.addEventListener(
        "click",
        function (event) {
          targetElement = event.target;
          classList = targetElement.classList;

          // ? Delete User
          if (classList.contains("delUser")) {
            event.preventDefault();
            userid = targetElement.dataset.userid;
            lname = targetElement.dataset.lname;
            fname = targetElement.dataset.fname;
            fullName = fname + " " + lname;

            if (
              window.confirm(
                "Are you sure you want to delete " + fullName + "?",
              )
            ) {
              fetch("database/delete-user.php", {
                method: "POST",
                headers: {
                  "Content-Type": "application/x-www-form-urlencoded",
                },
                body: new URLSearchParams({
                  user_id: userid,
                  last_name: lname,
                  first_name: fname,
                }),
              })
                .then((response) => {
                  if (!response.ok) throw new Error("Network error!");
                  return response.json();
                })
                .then((data) => {
                  if (data.success) {
                    if (window.confirm(data.message)) {
                      location.reload();
                    }
                  } else window.confirm(data.message);
                })
                .catch((error) => {
                  console.error("There was a problem: ", error);
                });
            } else {
              console.log("Do not delete user.");
            }
          }

          // ? Edit User
          if (classList.contains("editUser")) {
            event.preventDefault();

            user_id = targetElement.dataset.userid;

            first_name = targetElement.dataset.fname;
            last_name = targetElement.dataset.lname;
            email = targetElement.dataset.email;

            $("#editModal").modal("show");

            document.querySelector("#editModal .modal-title").innerHTML =
              `Update ${first_name} ${last_name}`;

            document.querySelector("#editModal .modal-body").innerHTML =
              this.buildEditForm(user_id, first_name, last_name, email);

            document
              .getElementById("updateUserForm")
              .addEventListener("submit", function (e) {
                e.preventDefault();
                var formData = new FormData(this);

                fetch("database/update-user.php", {
                  method: "POST",
                  body: formData,
                })
                  .then((response) => response.json())
                  .then((data) => {
                    if (data.success) {
                      alert(data.message);
                      location.reload();
                    } else {
                      alert(data.message);
                    }
                  })
                  .catch((error) => {
                    console.error("Error:", error);
                  });
              });
          }
        }.bind(this),
      );
    }));
}

var script = new script();
script.initialize();
