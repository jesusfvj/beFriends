//================ Fetching new methods =================//

function getPostById(id) {
  fetch(`./controllers/posts.php?id=${id}&controller=getpostbyid`)
    .then((res) => res.json())
    .then((data) => {
      // console.log(data);
    });
}

function checkUncheckLike(postId) {
  fetch(`./controllers/likes.php?id=${postId}&controller=checkunchecklike`)
    .then((res) => res.json())
    .then((data) => {});
}
checkUncheckLike(4);

function getLikesByPost(postId) {
  const likes = fetch(
    `./controllers/likes.php?id=${postId}&controller=getlikesbypost`
  )
    .then((res) => res.json())
    .then((data) => {
      return data;
    });
  return likes;
}

document.body.addEventListener("load", getUsers());
document.body.addEventListener("load", getPosts());
document.body.addEventListener("load", getLogedUser());

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

// Create comment

let commentPostId;

// create post form

// edit profile form
let editProfileImageToUpload;
const editProfileModal = document.getElementById("editProfileModal");
const editProfileForm = document.getElementById("editProfileForm");
const inputUserEditProfile = document.getElementById("inputUserEditProfile");
const inputNameEditProfile = document.getElementById("inputNameEditProfile");
const inputGenderEditProfile = document.getElementById(
  "inputGenderEditProfile"
);
const deleteAccountBtn = document.getElementById("deleteAccountBtn");
const updateProfileImgInput = document.getElementById("updateProfileImgInput");
const editThumbnailContainer = document.getElementById(
  "editThumbnailContainer"
);

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
const createComment = document.getElementById("createComment");
const feedOpenFriendsModalBtn = document.getElementById(
  "feedOpenFriendsModalBtn"
);
const feedFriendsModalCloseBtn = document.getElementById(
  "feedFriendsModalCloseBtn"
);
const feedFriendsListModal = document.getElementById("feedFriendsListModal");

const feedEditOpenModalBtn = document.getElementById("feedEditOpenModalBtn");
const editModalCloseBtn = document.getElementById("editModalCloseBtn");

const insertCommentModalCloseBtn = document.getElementById("insertCommentModalCloseBtn");

const insertCommentForm = document.getElementById("insertCommentForm");

feedCreatePostButton.addEventListener("click", toggleCreatePostModal);

createPostModalCloseBtn.addEventListener("click", toggleCreatePostModal);

feedOpenFriendsModalBtn.addEventListener("click", toggleFriendsModal);
feedFriendsModalCloseBtn.addEventListener("click", toggleFriendsModal);

feedEditOpenModalBtn.addEventListener("click", toggleEditModal);
editModalCloseBtn.addEventListener("click", toggleEditModal);

insertCommentModalCloseBtn.addEventListener("click", toggleCreateComment);
insertCommentForm.addEventListener("submit", insertComment);
// toggle modals controllers
feedLogoutBtn = document.getElementById("feedLogoutBtn");
feedLogoutBtn.addEventListener("click", logout);

function getLogedUser() {
  const loggedUserId = JSON.parse(localStorage.getItem("userId"));
  fetch(`./controllers/users.php?controller=getbyid&userid=${loggedUserId}`)
    .then((res) => res.json())
    .then((data) => {
      editProfileImageToUpload = data[0].avatar;
    });
}

function getUsers() {
  let suggestedFriendsCounter = 0;
  friendsSuggestionsContainer.innerHTML = "";
  fetch("./controllers/users.php?controller=get")
    .then((res) => res.json())
    .then((data) => {
      if (data.length) {
        data.forEach((user) => {
          if (suggestedFriendsCounter < 5) {
            friendsSuggestionsContainer.innerHTML += `
            <div class="feed__friends-suggestions-profile">
                <button onclick="addFriend(event)" class="feed__friends-suggestions-add-btn" userId=${user.id}>+</button>
                <img class="feed__post-profile-img" src=${user.avatar} alt="" userId=${user.id}/>
                <p>${user.nickname}</p>
            </div>
    `;
            suggestedFriendsCounter++;
          }
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
      const posts = data[0];
      const userId = data[1];
      feedPostsContainer.innerHTML = "";
      posts.forEach(async (post) => {
        const {
          avatar,
          nickname,
          created_at,
          image,
          postId,
          postOwner,
          postContent,
          comments,
        } = post;

        const likes = await getLikesByPost(postId);

        feedPostsContainer.innerHTML += `
            <article class="feed__post">
                <div class="feed__article-header">
                    <img class="feed__post-profile-img" src=${avatar} alt="" />
                    <div>
                        <p class="feed__post-profile-name">${nickname}</p>
                        <p class="feed__post-timestamp">${created_at}</p>
                    </div>
                  ${
                    userId == postOwner
                      ? `<button class="feed__post-delete-button" postId=${postId} onclick='deletePost(event)'>Delete</button>`
                      : ""
                  }
                </div>
                <img class="feed__post-img" src=${image} alt="" />
                <div class="feed__post-message-container">
                    <p class="feed__post-message">${postContent}</p>
                </div>
                <div class="feed__article-comments-container">
                    <div class="feed__post-icons-container">
                        <img class="feed__post-icon" src="./assets/images/heart.png" alt=""  />
                        <p>${likes} likes</p>
                        <img class="feed__post-icon" postId=${postId} src="./assets/images/message.png" alt="" onclick='toggleCreateComment(event)'>
                    </div>
                    <div class="feed__post-comments-container">
                    ${comments.map((comment) => {
                      const { nickname, postContent } = comment;
                      return `<div class = "feed__post-comment">
                      <p class = "feed__post-comment-author">${nickname} </p><p class = "feed__post-comment-message"> ${postContent} </p> </div>`;
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
        if (data[0] === true) {
          getPosts();
          toggleCreatePostModal();
        }
      });
  }
}

//delete post functions

function deletePost(event) {
  const postId = event.target.getAttribute("postId");
  fetch(`./controllers/posts.php?controller=deletepost&postid=${postId}`)
    .then((res) => res.json())
    .then((data) => {
      deletePostElement(event);
    });
}

function deletePostElement(event) {
  const elementDelete = event.target.parentNode.parentNode;

  feedPostsContainer.removeChild(elementDelete);
}

// edit profile functions
let hasImageChanged = false;

function uploadEditProfileImg(e) {
  editProfileImageToUpload = e.target.files[0];
  const img = document.createElement("img");

  img.classList.add("feed__edit-profile-thumbnail");
  img.editProfileImageToUpload = editProfileImageToUpload;

  editThumbnailContainer.innerHTML = "";
  editThumbnailContainer.appendChild(img);

  const reader = new FileReader();
  reader.onload = (e) => {
    img.src = e.target.result;
  };
  reader.readAsDataURL(editProfileImageToUpload);
  hasImageChanged = true;
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

  if (hasImageChanged) {
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
        editProfileImageToUpload = data.secure_url;
      });
  } else {
    formData.append("avatar", editProfileImageToUpload);
  }

  await fetch("./controllers/users.php?controller=update", {
    method: "POST",
    body: formData,
  })
    .then((res) => res.json())
    .then((data) => {
      editProfileModal.classList.add("hidden");
      hasImageChanged = false;
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

function toggleCreateComment(event){
  createComment.classList.toggle("hidden");
  commentPostId = event.target.getAttribute("postid");
}

function logout() {
  fetch("./controllers/users.php?controller=logout").then(
    () => (window.location.href = "index.php")
  );
}

const addFriendsButton = document.querySelectorAll(
  ".feed__friends-suggestions-add-btn"
);
const navImage = document.querySelector(".nav__image");
const friendListContainer = document.querySelector(".feed__friends-list");

navImage.addEventListener("click", showFriendList);

addFriendsButton.forEach((element) => {
  element.addEventListener("click", addFriend);
});

function addFriend(event) {
  const friendId = event.target.getAttribute("userid");
  fetch(`./controllers/friends.php?controller=addfriend&friendid=${friendId}`)
    .then((res) => res.json())
    .then((data) => {
      console.log(data);
      getUsers();
    });
}

function showFriendList() {
  friendListContainer.innerHTML = `<h2>Friends</h2>
                                   <p class="modal-close-btn" onclick="toggleFriendsModal()">x</p>
                                    `;

  fetch(`./controllers/friends.php?controller=getfriends`)
    .then((res) => res.json())
    .then((data) => {
      data.forEach((friend) => {
        let newFriend = document.createElement("div");
        newFriend.classList.add("feed__friend-container");
        newFriend.innerHTML = ` <img class="feed__friend-img" src="${friend.avatar}" alt="user avatar">
                                <p class="feed__friend-nickname">${friend.nickname}</p>`;

        friendListContainer.appendChild(newFriend);
      });
    });
}

function insertComment(event){
  event.preventDefault();
  commentPostId
  const inputComment = inputCommentInsert.value;

  fetch(`./controllers/comments.php?controller=addComment&inputComment=${inputComment}&commentPostId=${commentPostId}`)
    .then((res) => res.json())
    .then((data) => {
      if(data[0]===true){
        console.log(data[0])
        getPosts();
        toggleCreateComment();
      }
    });
}
