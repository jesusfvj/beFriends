const friendsSuggestionsContainer = document.querySelector(
  "#friendsSuggestionsContainer"
);

document.body.addEventListener("load", getUsers());
function getUsers() {
  fetch("./controllers/users/getAll.php")
    .then((res) => res.json())
    .then((data) => {
      if (data.length) {
        console.log(data);
        data.forEach((user) => {
          friendsSuggestionsContainer.innerHTML += `
            <div class="feed__friends-suggestions-profile">
                <button onclick="addFriend(event)" class="feed__friends-suggestions-add-btn" userId=${user.id}>+</button>
                <img class="feed__post-profile-img" src="./assets/images/profileImg.JPG" alt="" />
                <p>${user.nickname}</p>
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

document.body.addEventListener("load", createPost());
function createPost() {
  const formData = new FormData();
  
  formData.append("user_id", 1);
  formData.append("content", 'Content lorem ipsum content');
  formData.append("image", 'postImage.png');

  fetch("./controllers/posts/create.php", {
    method: "POST",
    body: formData
  })
    .then((res) => res.json())
    .then((data) => {

    });
}

// function updateUser() {
//   const formData = new FormData();
  
//   formData.append("id", 1);
//   formData.append("fullname", 'New fullname de los palotes');
//   formData.append("username", 'NewUsername');
//   formData.append("gender", 'Non binary');
//   formData.append("avatar", 'new-image.png');

//   fetch("./controllers/users/update.php", {
//     method: "POST",
//     body: formData
//   })
//     .then((res) => res.json())
//     .then((data) => {
//       console.log(data);
//     });
// }
// updateUser();


function addFriend(event) {
  console.log("Adding " + event.target.getAttribute("userId"));
}
