const friendsSuggestionsContainer = document.querySelector(
  "#friendsSuggestionsContainer"
);

const showParagraph = document.querySelectorAll(".paragraph-show__text");

showParagraph.forEach((element) => {
  element.addEventListener("click", togglePassword);
});

document.body.addEventListener("load", getUsers());
function getUsers() {
  fetch("./controllers/users/getAll.php")
    .then((res) => res.json())
    .then((data) => {
      if (data.length) {
        data.forEach((user) => {
          friendsSuggestionsContainer.innerHTML += `
            <div class="feed__friends-suggestions-profile">
                <button onclick="addFriend(event)" class="feed__friends-suggestions-add-btn" userId=${user.id}>+</button>
                <img class="feed__post-profile-img" src="./assets/images/profileImg.JPG" alt="" />
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

function addFriend(event) {
  console.log("Adding " + event.target.getAttribute("userId"));
}

function togglePassword(event) {
  const clickedShow = document.querySelector("#" + event.target.id);
  const clickedInput = document.querySelector(
    "#" + event.target.nextElementSibling.id
  );
  clickedInput.type == "password"
    ? ((clickedInput.type = "text"),
      (clickedShow.textContent = "Hide"),
      (clickedShow.style.color = "rgb(161, 161, 161)"))
    : ((clickedInput.type = "password"),
      (clickedShow.textContent = "Show"),
      (clickedShow.style.color = "black"));
}
