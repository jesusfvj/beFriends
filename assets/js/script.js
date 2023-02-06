//================ Fetching new methods =================//

function getPostById(id) {
  fetch(`./controllers/posts.php?id=${id}&controller=getpostbyid`)
    .then((res) => res.json())
    .then((data) => {
      // console.log(data);
    });
}
// getPostById(2);

function checkUncheckLike(postId) {
  fetch(`./controllers/likes.php?id=${postId}&controller=checkunchecklike`)
    .then((res) => res.json())
    .then((data) => {});
}
checkUncheckLike(4);

function getLikesByPost(postId) {
  fetch(`./controllers/likes.php?id=${postId}&controller=getlikesbypost`)
    .then((res) => res.json())
    .then((data) => {});
}
getLikesByPost(1);
//=======================================================//

document.body.addEventListener("load", getUsers());
document.body.addEventListener("load", getPosts());

const feedPostsContainer = document.getElementById("feedPostsContainer");

// create post form
const createPostForm = document.getElementById("createPostForm");
const postImageUpload = document.getElementById("postImageUpload");
const createPostText = document.getElementById("createPostText");
const feedCreatePostButton = document.getElementById("feedCreatePostButton");
const feedCreatePostModal = document.getElementById("feedCreatePostModal");
const createPostModalCloseBtn = document.getElementById(
  "createPostModalCloseBtn"
);
createPostForm.addEventListener("submit", createPost);
postImageUpload.addEventListener("change", getFiles);
// create post form

// edit profile form
const editProfileModal = document.getElementById("editProfileModal");
const editProfileForm = document.getElementById("editProfileForm");
const inputUserEditProfile = document.getElementById("inputUserEditProfile");
const inputNameEditProfile = document.getElementById("inputNameEditProfile");
const inputGenderEditProfile = document.getElementById(
  "inputGenderEditProfile"
);
const deleteAccountBtn = document.getElementById("deleteAccountBtn");
const updateProfileImgInput = document.getElementById("updateProfileImgInput");

editProfileForm.addEventListener("submit", submitEditForm);
updateProfileImgInput.addEventListener("change", uploadEditProfileImg);
deleteAccountBtn.addEventListener("click", toggleDeleteConfirmationModal);
// edit profile form

// delete confirmation

const deleteConfirmationModal = document.getElementById(
  "deleteConfirmationModal"
);
const deleteUserConfirm = document.getElementById("deleteUserConfirm");
const deleteUserDecline = document.getElementById("deleteUserDecline");
deleteUserConfirm.addEventListener("click", deleteUser);
deleteUserDecline.addEventListener("click", toggleDeleteConfirmationModal);
//

// toggle modals controllers
const feedOpenFriendsModalBtn = document.getElementById(
  "feedOpenFriendsModalBtn"
);
const feedFriendsModalCloseBtn = document.getElementById(
  "feedFriendsModalCloseBtn"
);
const feedFriendsListModal = document.getElementById("feedFriendsListModal");

const feedEditOpenModalBtn = document.getElementById("feedEditOpenModalBtn");
const editModalCloseBtn = document.getElementById("editModalCloseBtn");

//////////////////////////////////////////////////
feedPostsContainer.addEventListener("click", toggleCreatePostModal);
//////////////////////////////////////////////////
createPostModalCloseBtn.addEventListener("click", toggleCreatePostModal);

feedOpenFriendsModalBtn.addEventListener("click", toggleFriendsModal);
feedFriendsModalCloseBtn.addEventListener("click", toggleFriendsModal);

feedEditOpenModalBtn.addEventListener("click", toggleEditModal);
editModalCloseBtn.addEventListener("click", toggleEditModal);
// toggle modals controllers
feedLogoutBtn = document.getElementById("feedLogoutBtn");
feedLogoutBtn.addEventListener("click", logout);

function getUsers() {
  fetch("./controllers/users.php?controller=get")
    .then((res) => res.json())
    .then((data) => {
      if (data.length) {
        data.forEach((user) => {
          friendsSuggestionsContainer.innerHTML += `
            <div class="feed__friends-suggestions-profile">
                <button onclick="addFriend(event)" class="feed__friends-suggestions-add-btn" userId=${user.id}>+</button>
                <img class="feed__post-profile-img" src=${user.avatar} alt="" userId=${user.id}/>
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

function getPosts() {
  fetch("./controllers/posts.php?controller=getposts")
    .then((res) => res.json())
    .then((data) => {
      console.log(data);
      data.forEach((post) => {
        feedPostsContainer.innerHTML += ` 
            <article class="feed__post">
                <div class="feed__article-header">
                    <img class="feed__post-profile-img" src=${
                      post.avatar
                    } alt="" />
                    <div>
                        <p class="feed__post-profile-name">${post.nickname}</p>
                        <p class="feed__post-timestamp">${post.created_at}</p>
                    </div>
                </div>
                <img class="feed__post-img" src=${post.image} alt="" />
                <div class="feed__post-message-container">
                    <p class="feed__post-message">${post.postContent}</p>
                </div>
                <div class="feed__article-comments-container">
                    <div class="feed__post-icons-container">
                        <img class="feed__post-icon" src="./assets/images/heart.png" alt="" />
                        <p>${post.likes} likes</p>
                        <img class="feed__post-icon" src="./assets/images/message.png" alt="" />
                    </div>
                    <div class="feed__post-comments-container">
                    ${post.comments.map((comment) => {
                      return `
                            <div class="feed__post-comment">
                                <p class="feed__post-comment-author">${comment.nickname}</p>
                                <p class="feed__post-comment-message">${comment.postContent}</p>
                            </div>
                            `;
                    })}
                    </div>
                </div>
            </article>
            `;
      });
    });
}

// create post functions
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
    });

  if (text.length) {
    await fetch("./controllers/posts.php?controller=createpost", {
      method: "POST",
      body: formData,
    })
      .then((res) => res.json())
      .then((data) => {
        console.log(data);
      });
  }
}

// edit profile functions

let editProfileImageToUpload;

function uploadEditProfileImg(e) {
  editProfileImageToUpload = e.target.files[0];
}

async function submitEditForm(e) {
  e.preventDefault();
  const userId = e.target.getAttribute("userId");
  let image = editProfileImageToUpload;

  const formData = new FormData();
  formData.append("fullname", inputUserEditProfile.value);
  formData.append("username", inputNameEditProfile.value);
  formData.append("gender", inputGenderEditProfile.value);
  formData.append("id", userId);

  if (image) {
    const imgFormData = new FormData();
    imgFormData.append("file", image);
    imgFormData.append("api_key", "461164283284341");
    imgFormData.append("upload_preset", "j24srhjm");

    await fetch("https://api.cloudinary.com/v1_1/dfjelhshb/image/upload", {
      method: "POST",
      body: imgFormData,
    })
      .then((res) => res.json())
      .then((data) => {
        formData.append("avatar", data.secure_url);
      });
  }

  await fetch("./controllers/users.php?controller=update", {
    method: "POST",
    body: formData,
  })
    .then((res) => res.json())
    .then((data) => {
      console.log(data);
    });
}

function deleteUser() {
  fetch(`./controllers/users.php?controller=delete`)
    .then((res) => res.json())
    .then((data) => {
      deleteConfirmationModal.classList.toggle("hidden");
      editProfileModal.classList.toggle("hidden");
      window.location.href = "index.php";
    });
}

function addFriend(event) {
  console.log("Adding " + event.target.getAttribute("userId"));
}

function toggleDeleteConfirmationModal(e) {
  e.preventDefault();
  deleteConfirmationModal.classList.toggle("hidden");
}

function toggleCreatePostModal() {
  feedCreatePostModal.classList.toggle("hidden");
}

function toggleFriendsModal() {
  feedFriendsListModal.classList.toggle("hidden");
}

function toggleEditModal() {
  editProfileModal.classList.toggle("hidden");
}

function logout() {
  fetch("./controllers/users.php?controller=logout").then(
    () => (window.location.href = "index.php")
  );
}
