const friendsSuggestionsContainer = document.querySelector(
  "#friendsSuggestionsContainer"
);

const createPostForm = document.getElementById("createPostForm");
const postImageUpload = document.getElementById("postImageUpload");
const createPostText = document.getElementById("createPostText");

document.body.addEventListener("load", getUsers());
createPostForm.addEventListener("submit", createPost);
postImageUpload.addEventListener("change", getFiles);

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

let imageToUpload;

function getFiles(e) {
  imageToUpload = e.target.files[0];
}

async function createPost(e) {
  e.preventDefault();
  let text = createPostText.value;
  let image = imageToUpload;

  const imgFormData = new FormData();
  imgFormData.append("file", image);
  imgFormData.append("api_key", "461164283284341");
  imgFormData.append("upload_preset", "j24srhjm");

  const formData = new FormData();
  formData.append("content", text);

  await fetch("https://api.cloudinary.com/v1_1/dfjelhshb/image/upload", {
    method: "POST",
    body: imgFormData,
  })
    .then((res) => res.json())
    .then((data) => {
      formData.append("image", data.secure_url);
      console.log(data);
    });

  if (text.length) {
    await fetch("./controllers/posts/create.php", {
      method: "POST",
      body: formData,
    })
      .then((res) => res.json())
      .then((data) => {
        console.log(data);
      });
  }
}

function addFriend(event) {
  console.log("Adding " + event.target.getAttribute("userId"));
}
