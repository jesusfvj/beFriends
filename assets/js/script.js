//================ Fetching new methods =================//

function getPostById(id) {
  fetch(`./controllers/posts.php?id=${id}&controller=getpostbyid`)
    .then((res) => res.json())
    .then((data) => {});
}

// function getPostsByUserId(userId) {
//   fetch(`./controllers/posts.php?userId=${userId}&controller=getpostsbyuserid`)
//     .then((res) => res.json())
//     .then((data) => {
//       console.log(data);
//     });
// }
// getPostsByUserId(1);

document.body.addEventListener("load", getUsers());
// document.body.addEventListener("load", getPosts());
document.body.addEventListener("load", getLogedUser());

const spinner = document.querySelector(".spinner");

const feedPostsContainer = document.getElementById("feedPostsContainer");

//infinity scroll

const spinnerScroll = document.getElementById("spinnerLoaded");
document.addEventListener("DOMContentLoaded", infinityScroll);
let page = 1;

const beFriendsLogo = document.getElementById("beFriendsLogo");
beFriendsLogo.addEventListener("click", getPosts);

// create post form
const createPostForm = document.getElementById("createPostForm");
const postImageUpload = document.getElementById("postImageUpload");
const createPostText = document.getElementById("createPostText");
const feedCreatePostButton = document.getElementById("feedCreatePostButton");
const feedCreatePostModal = document.getElementById("feedCreatePostModal");
const createPostModalCloseBtn = document.getElementById(
  "createPostModalCloseBtn"
);
const createPostThumbnailContainer = document.getElementById(
  "createPostThumbnailContainer"
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

//search modal
const feedOpenSearchModalBtn = document.getElementById(
  "feedOpenSearchModalBtn"
);
const feedSearchUsersModal = document.getElementById("feedSearchUsersModal");
const feedSearchModalCloseBtn = document.getElementById(
  "feedSearchModalCloseBtn"
);
const feedSearchInput = document.getElementById("feedSearchInput");
const feedSearchResult = document.getElementById("feedSearchResult");
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

const insertCommentModalCloseBtn = document.getElementById(
  "insertCommentModalCloseBtn"
);

const insertCommentForm = document.getElementById("insertCommentForm");

feedCreatePostButton.addEventListener("click", toggleCreatePostModal);

createPostModalCloseBtn.addEventListener("click", toggleCreatePostModal);

feedOpenFriendsModalBtn.addEventListener("click", toggleFriendsModal);
feedFriendsModalCloseBtn.addEventListener("click", toggleFriendsModal);

feedEditOpenModalBtn.addEventListener("click", toggleEditModal);
editModalCloseBtn.addEventListener("click", toggleEditModal);

feedOpenSearchModalBtn.addEventListener("click", toggleSearchModal);
feedSearchModalCloseBtn.addEventListener("click", toggleSearchModal);
feedSearchInput.addEventListener("keyup", searchUsers);

insertCommentModalCloseBtn.addEventListener("click", toggleCreateComment);
insertCommentForm.addEventListener("submit", insertComment);
// toggle modals controllers
feedLogoutBtn = document.getElementById("feedLogoutBtn");
feedLogoutBtn.addEventListener("click", logout);

const userAvatar = document.querySelector(".feed__user-avatar");

function getLogedUser() {
  const loggedUserId = JSON.parse(localStorage.getItem("userId"));
  fetch(`./controllers/users.php?controller=getbyid&userid=${loggedUserId}`)
    .then((res) => res.json())
    .then((data) => {
      userAvatar.src = data[0].avatar;
      editProfileImageToUpload = data[0].avatar;
    });
}

function getUsers() {
  friendsSuggestionsContainer.innerHTML = `<div class="feed__friends-suggestions-profile">
                                          <p>Friends suggestions</p>
                                          </div>`;
  fetch("./controllers/users.php?controller=get")
    .then((res) => res.json())
    .then((data) => {
      if (data.length) {
        data.forEach((user, index) => {
          if (index < 5) {
            friendsSuggestionsContainer.innerHTML += `
            <div class="feed__friends-suggestions-profile">
            <div class="feed__friends-suggestions-btn-group">
                <button onclick="addFriend(event)" class="feed__friends-suggestions-add-btn" userId=${user.id}>+</button>
                <button onclick="deleteFriend(event)" class="feed__friends-suggestions-deny-btn" userId=${user.id}>x</button>
            </div>
                <img class="feed__post-profile-img" src=${user.avatar} alt="" userId=${user.id}/>
                <p>${user.nickname}</p>
            </div>
    `;
          }
        });
      } else {
        friendsSuggestionsContainer.innerHTML = `
              <div class="feed__friends-suggestions-profile">
                 <p>No friends to suggest</p>
              </div>
      `;
      }
    });
}

function printPosts(posts, userId) {
  // spinner.removeAttribute('hidden');
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
      likesCount,
      isLiked,
    } = post;

    feedPostsContainer.innerHTML += `
            <article class="feed__post">
                <div class="feed__article-header">
                    <img class="feed__post-profile-img" src=${avatar} alt="" />
                    <div userId=${postOwner}" class="user-info-container" onclick="getPostsByUserId(${postOwner})">
                        <p userId=${postOwner} class="feed__post-profile-name">${nickname}</p>
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
                        <img onclick="checkUncheckLike(event)" postId=${postId} class="feed__post-icon" src=${
      isLiked ? "./assets/images/likeGiven.png" : "./assets/images/giveLike.png"
    } alt=""  />
                        <p id="likes_${postId}">${likesCount} likes</p>
                        <img class="feed__post-icon" postId=${postId} src="./assets/images/message.png" alt="" onclick='toggleCreateComment(event)'>
                    </div>
                    <div class="feed__post-comments-container">
                    ${comments
                      .map((comment) => {
                        const { nickname, postContent } = comment;
                        return `<div class = "feed__post-comment">
                                <p class="feed__post-comment-author">${nickname}</p>
                                <p class="feed__post-comment-message">${postContent}</p>
                              </div>`;
                      })
                      .join("")}
                    </div>
                </div>
            </article>
            `;
  // spinner.setAttribute('hidden', '');
  });
}
let isAllPostsPageActive = true;

function getPosts(page) {
  fetch(`./controllers/posts.php?controller=getposts&page=${page}`)
    .then((res) => res.json())
    .then((data) => {
      console.log(data);
      if (!isAllPostsPageActive) {
        feedPostsContainer.innerHTML = "";
        feedCreatePostButton.textContent = "Create post";
        feedCreatePostButton.removeEventListener("click", getPosts);
        feedCreatePostButton.addEventListener("click", toggleCreatePostModal);
        feedCreatePostButton.classList.toggle("feed__create-post-button");
        feedCreatePostButton.classList.toggle("feed__back-to-posts-button");
        isAllPostsPageActive = true;
      }
      const posts = data[0];
      const userId = data[1];
      if (posts.length < 5) {
        spinnerScroll.classList.toggle("hidden");
      }
      printPosts(posts, userId);
    });
}

function getPostsByUserId(id) {
  spinner.removeAttribute("hidden");
  fetch(`./controllers/posts.php?userId=${id}&controller=getpostsbyuserid`)
    .then((res) => res.json())
    .then((data) => {
      if (isAllPostsPageActive) {
        feedPostsContainer.innerHTML = "";
        feedCreatePostButton.textContent = "Back to all posts";
        feedCreatePostButton.removeEventListener(
          "click",
          toggleCreatePostModal
        );
        feedCreatePostButton.addEventListener("click", getPosts);
        feedCreatePostButton.classList.toggle("feed__create-post-button");
        feedCreatePostButton.classList.toggle("feed__back-to-posts-button");
        isAllPostsPageActive = false;
      }
      printPosts(data[0], data[1]);
      spinner.setAttribute("hidden", "");
    });
}

function checkHasLike(postId) {
  spinner.removeAttribute("hidden");
  const hasLikes = fetch(
    `./controllers/likes.php?post_id=${postId}&controller=checkhaslike`
  )
    .then((res) => res.json())
    .then((data) => {
      spinner.setAttribute("hidden", "");
      return data;
    });
  return hasLikes;
}

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

function checkUncheckLike(event) {
  const postId = event.target.getAttribute("postId");
  const likesCountDisplay = document.getElementById(`likes_${postId}`);

  fetch(`./controllers/likes.php?id=${postId}&controller=checkunchecklike`)
    .then((res) => res.json())
    .then(async (data) => {
      data
        ? (event.target.src = "./assets/images/likeGiven.png")
        : (event.target.src = "./assets/images/giveLike.png");

      const likesCount = await getLikesByPost(postId);
      likesCountDisplay.textContent = `${likesCount} likes`;
    });
}

// create post functions
let imageToUpload;

function getFiles(e) {
  imageToUpload = e.target.files[0];
  const img = document.createElement("img");

  img.classList.add("feed__edit-profile-thumbnail");
  img.imageToUpload = imageToUpload;
  img.style.width = "50%";
  createPostThumbnailContainer.innerHTML = "";
  createPostThumbnailContainer.appendChild(img);

  const reader = new FileReader();
  reader.onload = (e) => {
    img.src = e.target.result;
  };
  reader.readAsDataURL(imageToUpload);
}

async function createPost(e) {
  e.preventDefault();
  spinner.removeAttribute("hidden");

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
      spinner.setAttribute('hidden', '');
      feedPostsContainer.innerHTML = "";
          if(spinnerScroll.classList.contains("hidden")){
            spinnerScroll.classList.toggle("hidden");
          };
          
          page = 1;
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
          spinner.setAttribute("hidden", "");
        }
      });
  }
}

//delete post functions

function deletePost(event) {
  spinner.removeAttribute("hidden");
  const postId = event.target.getAttribute("postId");
  fetch(`./controllers/posts.php?controller=deletepost&postid=${postId}`)
    .then((res) => res.json())
    .then((data) => {
      deletePostElement(event);
      spinner.setAttribute("hidden", "");
    });
}

function deletePostElement(event) {
  const elementDelete = event.target.parentNode.parentNode;

  feedPostsContainer.removeChild(elementDelete);
}

// edit profile functions
let hasImageChanged = false;

function uploadEditProfileImg(e) {
  spinner.removeAttribute("hidden");
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
  spinner.setAttribute("hidden", "");
}

async function submitEditForm(e) {
  e.preventDefault();
  spinner.removeAttribute("hidden");
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
      spinner.setAttribute("hidden", "");
    });
}

function deleteUser() {
  spinner.removeAttribute("hidden");
  fetch(`./controllers/users.php?controller=delete`)
    .then((res) => res.json())
    .then((data) => {
      deleteConfirmationModal.classList.toggle("hidden");
      editProfileModal.classList.toggle("hidden");
      spinner.setAttribute("hidden", "");
      window.location.href = "index.php";
    });
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

function toggleSearchModal() {
  spinner.removeAttribute("hidden");
  feedSearchUsersModal.classList.toggle("hidden");
  feedSearchResult.innerHTML = "";
  feedSearchInput.value = "";

  friends.map((friend) => {
    const { friendId, nickname, avatar } = friend;

    feedSearchResult.innerHTML += `
        <div class="feed__found-user-container">
           <div class="feed__found-user-btn-group">
                <button onclick="deleteFriend(event)" class="feed__found-user-delete-btn" userid=${friendId}>x</button>
            </div>   
            <div class="feed__found-user-info-group">
                <img class="feed__found-user-profile-img" src=${avatar} alt="" userId=${friendId}/>
                <p>${nickname}</p>
            </div>   
        </div>
    `;
  });
  nonFriends.map((nonFriend) => {
    const { id, nickname, avatar } = nonFriend;
    feedSearchResult.innerHTML += `
        <div class="feed__found-user-container">
            <div class="feed__found-user-btn-group">
                <button onclick="addFriend(event)" class="feed__found-user-add-btn" userid=${id}>+</button>
                <button onclick="deleteFriend(event)" class="feed__found-user-delete-btn" userid=${id}>x</button>
            </div>   
            <div class="feed__found-user-info-group">
                <img class="feed__found-user-profile-img" src=${avatar} alt="" userId=${id}/>
                <p>${nickname}</p>
            </div>   
        </div>
    `;
  });
  spinner.setAttribute("hidden", "");
}

function toggleCreateComment(event) {
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
navImage.addEventListener("click", getNotificationsCounter);

addFriendsButton.forEach((element) => {
  element.addEventListener("click", addFriend);
});

function addFriend(event) {
  spinner.removeAttribute("hidden");
  const friendId = event.target.getAttribute("userid");

  fetch(`./controllers/friends.php?controller=addfriend&friendid=${friendId}`)
    .then((res) => res.json())
    .then(async (data) => {
      getUsers();
      showNotifications();
      await getNoFriends();
      await getFriends();
      searchUsers();
      spinner.setAttribute("hidden", "");
    });
}

async function showFriendList() {
  spinner.removeAttribute("hidden");
  friendListContainer.innerHTML = ` <div id="counterAlertNotParent" class="friends-list__alert-counter-parent">
                                      <img class="friends-list__img-icon" src="./assets/images/bellEmpty.png" alt="notification icon">
                                      <div id="counterAlertNot" class="friends-list__alert-counter"></div>
                                    </div>
                                    <h2>Friends</h2>
                                    <p class="modal-close-btn" onclick="toggleFriendsModal()">x</p>
                                    `;

  await fetch(`./controllers/friends.php?controller=getfriends`)
    .then((res) => res.json())
    .then(async (data) => {
      await data.forEach((friend) => {
        let newFriend = document.createElement("div");
        newFriend.classList.add("feed__friend-container");
        newFriend.innerHTML = ` <button class="feed__friend-delete" userid="${friend.friendId}">x</button>
                                <img class="feed__friend-img" src="${friend.avatar}" alt="user avatar">
                                <p class="feed__friend-nickname">${friend.nickname}</p>`;

        friendListContainer.appendChild(newFriend);
      });
      spinner.setAttribute("hidden", "");
    });
  const deleteButton = document.querySelectorAll(".feed__friend-delete");
  const bellIcon = document.querySelector(".friends-list__img-icon");
  deleteButton.forEach((deleteBtn) => {
    deleteBtn.addEventListener("click", deleteFriend);
  });
  bellIcon.addEventListener("click", showNotifications);
  bellIcon.addEventListener("click", getNotificationsCounter);
}

function deleteFriend(event) {
  spinner.removeAttribute("hidden");
  const friendId = event.target.getAttribute("userid");
  fetch(
    `./controllers/friends.php?controller=deletefriend&friendid=${friendId}`
  )
    .then((res) => res.json())
    .then(async (data) => {
      showFriendList();
      getUsers();
      await getNoFriends();
      await getFriends();
      searchUsers();
      spinner.setAttribute("hidden", "");
    });
}

let nonFriends;
async function getNoFriends() {
  spinner.removeAttribute("hidden");
  await fetch("./controllers/users.php?controller=get")
    .then((res) => res.json())
    .then((data) => {
      nonFriends = data;
      spinner.setAttribute("hidden", "");
    });
  return nonFriends;
}
getNoFriends();

let friends;
async function getFriends() {
  spinner.removeAttribute("hidden");
  await fetch("./controllers/friends.php?controller=getfriends")
    .then((res) => res.json())
    .then((data) => {
      friends = data;
      spinner.setAttribute("hidden", "");
    });
  return friends;
}
getFriends();

async function searchUsers() {
  spinner.removeAttribute("hidden");
  const feedSearchInput = document.getElementById("feedSearchInput");
  feedSearchResult.innerHTML = "";
  const searchText = feedSearchInput.value;

  let foundFriends = friends.filter((friend) => {
    if (friend.nickname.toLowerCase().includes(searchText.toLowerCase())) {
      return friend.nickname;
    }
  });

  let foundNonFriends = nonFriends.filter((nonFriend) => {
    if (nonFriend.nickname.toLowerCase().includes(searchText.toLowerCase())) {
      return nonFriend.nickname;
    }
  });

  foundFriends.map((foundFriend) => {
    const { friendId, nickname, avatar } = foundFriend;
    feedSearchResult.innerHTML += `
        <div class="feed__found-user-container">
           <div class="feed__found-user-btn-group">
                <button onclick="deleteFriend(event)" class="feed__found-user-delete-btn" userid=${friendId}>x</button>
            </div>   
            <div class="feed__found-user-info-group">
                <img class="feed__found-user-profile-img" src=${avatar} alt="" userId=${friendId}/>
                <p>${nickname}</p>
            </div>   
        </div>
    `;
  });
  foundNonFriends.map((foundNonFriend) => {
    const { id, nickname, avatar } = foundNonFriend;
    feedSearchResult.innerHTML += `
        <div class="feed__found-user-container">
            <div class="feed__found-user-btn-group">
                <button onclick="addFriend(event)" class="feed__found-user-add-btn" userid=${id}>+</button>
                <button onclick="deleteFriend(event)" class="feed__found-user-delete-btn" userid=${id}>x</button>
            </div>   
            <div class="feed__found-user-info-group">
                <img class="feed__found-user-profile-img" src=${avatar} alt="" userId=${id}/>
                <p>${nickname}</p>
            </div>   
        </div>
    `;
  });
  spinner.setAttribute("hidden", "");
}

function insertComment(event) {
  spinner.removeAttribute("hidden");
  event.preventDefault();
  commentPostId;
  const inputComment = inputCommentInsert.value;

  fetch(
    `./controllers/comments.php?controller=addComment&inputComment=${inputComment}&commentPostId=${commentPostId}`
  )
    .then((res) => res.json())
    .then((data) => {
      if (data[0] === true) {
        getPosts();
        toggleCreateComment();
        spinner.setAttribute("hidden", "");
      }
    });
}

async function showNotifications() {
  spinner.removeAttribute("hidden");
  friendListContainer.innerHTML = "";
  friendListContainer.innerHTML = ` <div id="counterAlertNotParent" class="friends-list__alert-counter-parent">
                                      <img class="friends-list__img-icon" src="./assets/images/bellEmpty.png" alt="notification icon">
                                      <div id="counterAlertNot" class="friends-list__alert-counter"></div>
                                    </div>
                                    <h2>Notifications</h2>
                                    <p class="modal-close-btn" onclick="toggleFriendsModal()">x</p>`;

  await fetch(`./controllers/friends.php?controller=getnotifications`)
    .then((res) => res.json())
    .then((data) => {
      data.forEach((notification) => {
        let newNotification = document.createElement("div");
        newNotification.classList.add("feed__notification-container");
        newNotification.innerHTML = ` <button class="feed__notification-delete" userid="${notification.user_id}">x</button>
                              <img class="feed__notification-img" src="${notification.avatar}" alt="user avatar">
                              <p class="feed__notification-nickname">${notification.nickname}</p>
                              <button class="feed__notification-follow-back-btn" userid="${notification.user_id}">Follow back</button>`;

        friendListContainer.appendChild(newNotification);
      });
      spinner.setAttribute("hidden", "");
    });

  const followBackBtn = document.querySelectorAll(
    ".feed__notification-follow-back-btn"
  );
  followBackBtn.forEach((followBack) => {
    followBack.addEventListener("click", addFriend);
  });

  const denyFollowBack = document.querySelectorAll(
    ".feed__notification-delete"
  );
  denyFollowBack.forEach((denyFollowBtn) => {
    denyFollowBtn.addEventListener("click", denyFollow);
  });

  const bellIcon = document.querySelector(".friends-list__img-icon");
  bellIcon.addEventListener("click", showFriendList);
  bellIcon.addEventListener("click", getNotificationsCounter);
}

function denyFollow(event) {
  spinner.removeAttribute("hidden");
  const friendId = event.target.getAttribute("userid");
  fetch(
    `./controllers/friends.php?controller=denyfriendrequest&friendid=${friendId}`
  )
    .then((res) => res.json())
    .then((data) => {
      getUsers();
      showNotifications();
      spinner.setAttribute("hidden", "");
    });
}

function naviagateToWall(event) {
  const userId = event.target.getAttribute("userId");
  window.location.href = `./wall.php?userId=${userId}`;
}

setInterval(() => {
  fetch(`./controllers/friends.php?controller=getnotificationsalertcount`)
    .then((res) => res.json())
    .then((data) => {
      printNotificationsAlert(data[0][0]);
    });
}, 1500);

function printNotificationsAlert(data) {
  const alertCounterNot = document.querySelectorAll(
    ".friends-list__alert-counter"
  );
  if (data != "0") {
    alertCounterNot.forEach((element) => {
      element.style.display = "block";
    });
    if (alertCounterNot) {
      alertCounterNot.forEach((element) => {
        element.textContent = data;
      });
    }
  } else {
    alertCounterNot.forEach((element) => {
      element.style.display = "none";
    });
  }
}

window.addEventListener("DOMContentLoaded", getNotificationsCounter);

function getNotificationsCounter() {
  fetch(`./controllers/friends.php?controller=getnotificationsalertcount`)
    .then((res) => res.json())
    .then((data) => {
      printNotificationsAlert(data[0][0]);
    });
}

function infinityScroll() {

  const observeSpinner = async listPost => {
    if (listPost[0].isIntersecting) {
      await getPosts(page);
      page++
    }
  }
  const options = {
    threshold: 0.9
  }
  let observer = new IntersectionObserver(observeSpinner, options);

  observer.observe(spinnerScroll)
}