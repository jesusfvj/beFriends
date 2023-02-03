<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>beFriends - feed</title>
    <link rel="stylesheet" href="./assets/css/feed.css?v=<?php echo time(); ?>">
    <script src="./assets/js/script.js?v=<?php echo time(); ?>" defer></script>
</head>

<body class="feed__body">
    <aside class="feed__aside">
        <div class="feed__aside-nav-container">
            <img src="./assets/images/logoBeFriends.png" alt="logo" class="feed__aside-logo" />
            <nav class="feed__nav">
                <div class="feed__nav-item" id="feedOpenFriendsModalBtn">
                    <img src=" ./assets/images/profile.png" alt="nav-icon" class="nav__image" />
                    <p>Friends</p>
                </div>
                <div class="feed__nav-item" id="feedEditOpenModalBtn">
                    <img src="./assets/images/profile.png" alt="nav-icon" class="nav__image" />
                    <p>Profile</p>
                </div>
                <div class="feed__nav-item">
                    <img src="./assets/images/profile.png" alt="nav-icon" class="nav__image" />
                    <p>Search</p>
                </div>
                <div class="feed__nav-item">
                    <img src="./assets/images/profile.png" alt="nav-icon" class="nav__image" />
                    <p>Logout</p>
                </div>
            </nav>
        </div>
    </aside>
    <main class="feed__main">
        <button class="feed__create-post-button" id="feedCreatePostButton">Create post</button>
        <article class="feed__post">
            <div class="feed__article-header">
                <img class="feed__post-profile-img" src="./assets/images/profileImg.JPG" alt="" />
                <div>
                    <p class="feed__post-profile-name">MIQUEL_ABELLA - <span class="feed__post-profile-follow-text">follow</span></p>
                    <p class="feed__post-timestamp">1 week ago</p>
                </div>
            </div>
            <img class="feed__post-img" src="./assets/images/mockImage.JPG" alt="" />
            <div class="feed__post-message-container">
                <p class="feed__post-message">Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque cum consequuntur iusto illo illum quis sunt facere, ullam expedita, repellendus, ab esse! Velit, saepe quis. Perferendis doloremque ipsum rem beatae.</p>
            </div>
            <div class="feed__article-comments-container">
                <div class="feed__post-icons-container">
                    <img class="feed__post-icon" src="./assets/images/heart.png" alt="" />
                    <p>5 likes</p>
                    <img class="feed__post-icon" src="./assets/images/message.png" alt="" />
                </div>
                <div class="feed__post-comments-container">
                    <div class="feed__post-comment">
                        <p class="feed__post-comment-author">Wilson</p>
                        <p class="feed__post-comment-message">Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque cum consequuntur iusto illo illum quis sunt facere, ullam expedita, repellendus, ab esse! Velit, saepe quis. Perferendis doloremque ipsum rem beatae.</p>
                    </div>
                    <div class="feed__post-comment">
                        <p class="feed__post-comment-author">Wilson</p>
                        <p class="feed__post-comment-message">Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque cum consequuntur iusto illo illum quis sunt facere, ullam expedita, repellendus, ab esse! Velit, saepe quis. Perferendis doloremque ipsum rem beatae.</p>
                    </div>
                    <div class="feed__post-comment">
                        <p class="feed__post-comment-author">Wilson</p>
                        <p class="feed__post-comment-message">Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque cum consequuntur iusto illo illum quis sunt facere, ullam expedita, repellendus, ab esse! Velit, saepe quis. Perferendis doloremque ipsum rem beatae.</p>
                    </div>
                </div>
            </div>
        </article>
    </main>
    <aside class="feed__friends-suggestions">
        <div class="feed__friends-suggestions-friends" id="friendsSuggestionsContainer">
            <p>Suggested friends for you</p>
        </div>
    </aside>

    <!-- create post modal -->

    <div class="modal hidden" id="feedCreatePostModal">
        <form class="feed__create-post-form" id="createPostForm">
            <label for="postImageUpload" class="feed__post-image-label">Add image</label>
            <input id="postImageUpload" class="hidden" type="file" />
            <textarea class="feed__create-post-form-textarea" id="createPostText" rows="6" placeholder="What are your thoughts?"></textarea>
            <input type="submit" value="Post!" class="feed__create-post-form-button" />
            <p class="modal-close-btn" id="createPostModalCloseBtn">x</p>
        </form>
    </div>

    <!-- list friends modal -->

    <div class="modal hidden" id="feedFriendsListModal">
        <div class=" feed__friends-list">
            <h2>Friends</h2>
            <p class="modal-close-btn" id="feedFriendsModalCloseBtn">x</p>
        </div>
    </div>

    <!-- edit profile -->

    <div class="modal hidden" id="editProfileModal">
        <div class="feed__edit-profile">
            <p class="modal-close-btn" id="editModalCloseBtn">x</p>
            <form class="edit-form__container" id="editProfileForm">
                <div class="edit-form-div__input">
                    <p class="paragraph-placeholder__text">Name</p>
                    <input class="edit-form__input" id="inputUserEditProfile" type="text" name="inputUserEditProfile" required>
                </div>
                <div class="edit-form-div__input">
                    <p class="paragraph-placeholder__text">User</p>
                    <input class="edit-form__input" id="inputNameEditProfile" type="text" name="inputNameEditProfile" required>
                </div>
                <div class="edit-form-div__input">
                    <p class="paragraph-placeholder__text">Gender</p>
                    <select class="edit-form__input" id="inputGenderEditProfile" type="text" name="inputGenderEditProfile" required>
                        <option></option select>
                        <option>Female</option>
                        <option>Male</option>
                        <option>Non binary</option>
                        <option>Doesn't apply</option>
                    </select>
                </div>
                <label class="edit-profile-image-label" for="updateProfileImgInput">Edit profile image</label>
                <input id="updateProfileImgInput" class="hidden" type="file" />
                <input type="submit" class="edit-form__button" value="Edit">
                <button class="edit-form__delete-user" id="deleteAccountBtn">Delete your account</button>
            </form>
        </div>
    </div>
    <!-- delete confirmation modal -->
    <div class="modal hidden" id="deleteConfirmationModal">
        <div class="feed__delete-confirmation-modal">
            <h2>Are your sure?</h2>
            <div class="feed__delete-confirmation-modal-btn-group">
                <button class="feed__delete-confirmation-modal-btn feed__delete-confirmation-modal-btn-accept" id="deleteUserConfirm">Yes</button>
                <button class="feed__delete-confirmation-modal-btn feed__delete-confirmation-modal-btn-decline" id="deleteUserDecline">No</button>
            </div>
        </div>
    </div>
</body>

</html>