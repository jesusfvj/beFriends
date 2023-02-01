const friendsSuggestionsContainer = document.querySelector(
  "#friendsSuggestionsContainer"
);

document.body.addEventListener("load", getUsers());
function getUsers() {
  fetch("./controllers/getUsers.php")
    .then((res) => res.json())
    .then((data) => {
      if (data.length) {
        data.forEach((user) => {
          friendsSuggestionsContainer.innerHTML += `
            <div class="feed__friends-suggestions-profile">
                <button onclick="addFriend(event)" class="feed__friends-suggestions-add-btn" userId=${user[0]}>+</button>
                <img class="feed__post-profile-img" src="./assets/profileImg.JPG" alt="" />
                <p>${user.name}</p>
            </div>
    `;
        });
      } else {
        friendsSuggestionsContainer.innerHTML += `
            <div class="feed__friends-suggestions-profile">
               <p>No friends to suggest</p>
            </div>
    `;
      }
    });
}

function addFriend(event) {
  console.log("Adding " + event.target.getAttribute("userId"));
}
