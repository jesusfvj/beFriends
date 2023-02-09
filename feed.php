<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("location: ./index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>beFriends - feed</title>
    <link rel="icon" type="image/png" href="./assets/images/logoFavicon.png"/>
    <link rel="stylesheet" href="./assets/css/feed.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="./assets/css/utils.css?v=<?php echo time(); ?>">
    <script src="./assets/js/script.js?v=<?php echo time(); ?>" defer></script>
    <script src="./assets/js/api/user.js?=<?php echo time(); ?>" defer></script>
</head>

<body class="feed__body">
    <div hidden class="spinner"></div>
    <div class="feed__user-login" id="profileInfoTopLeft" userId="<?php echo $_SESSION['id']; ?>">
        <img userId="<?php echo $_SESSION['id']; ?>" class="feed__user-avatar profile-img-<?php echo $_SESSION['id']; ?>" src="./assets/images/defaultProfileImg.png" alt="user avatar">
        <p userId="<?php echo $_SESSION['id']; ?>"><?php echo $_SESSION['nickname'] ?></p>
    </div>
    <aside class="feed__friends-suggestions">
        <div class="feed__friends-suggestions-friends" id="friendsSuggestionsContainer">
            <p>Suggested friends for you</p>
        </div>
    </aside>
    <main class="feed__main" id="feedPostsContainer"></main>
    <aside class="feed__aside">
        <div class="feed__aside-nav-container">
            <img src="./assets/images/logoBeFriends.png" alt="logo" class="feed__aside-logo" id="beFriendsLogo" />
            <nav class="feed__nav">
                <div class="feed__nav-item friends-list__alert-counter-parent" id="feedOpenFriendsModalBtn">
                    <img src=" ./assets/images/friends.png" alt="nav-icon" class="nav__image" />
                    <div id="counterAlertNot" class="friends-list__alert-counter"></div>
                </div>
                <div class="feed__nav-item" id="feedEditOpenModalBtn">
                    <img src="./assets/images/editProfile.png" alt="nav-icon" id="editModalOpenBtn" class="nav__image" />
                </div>
                <div class="feed__nav-item">
                    <img src="./assets/images/searchFriends.png" id="feedOpenSearchModalBtn" alt="nav-icon" class="nav__image" />
                </div>
                <div class="feed__nav-item" id="feedLogoutBtn">
                    <img src="./assets/images/logout.png" alt="nav-icon" class="nav__image" />
                </div>
            </nav>
        </div>
    </aside>
    <main class="feed__main" id="feedPostsContainer"></main>
    <button class="feed__create-post-button" id="feedCreatePostButton">Create post</button>


    <!-- create post modal -->

    <div class="modal hidden" id="feedCreatePostModal">
        <form class="feed__create-post-form" id="createPostForm">
            <label for="postImageUpload" class="feed__post-image-label">Add image</label>
            <input id="postImageUpload" class="hidden" type="file" />
            <div id="createPostThumbnailContainer" class="create-post-thumbnail-container">
            </div>
            <textarea class="feed__create-post-form-textarea" id="createPostText" rows="6" placeholder="What are your thoughts?"></textarea>
            <input type="submit" value="Post!" class="feed__create-post-form-button" />
            <p class="modal-close-btn" id="createPostModalCloseBtn">x</p>
        </form>
    </div>

    <!-- list friends modal -->

    <div class="modal hidden" id="feedFriendsListModal">
        <div id="feedFriendsList" class="feed__friends-list">
            <h2>Friends</h2>
            <p class="modal-close-btn" id="feedFriendsModalCloseBtn">x</p>
        </div>
    </div>

    <!-- search modal -->

    <div class="modal hidden" id="feedSearchUsersModal">
        <div id="feedSearchModal" class="feed__friends-list">
            <p class="modal-close-btn" id="feedSearchModalCloseBtn">x</p>
            <input type="text" id="feedSearchInput" class="feed__search-input">
            <div id="feedSearchResult" class="feed__search-result-container">
            </div>
        </div>
    </div>

    <!-- edit profile -->
    <div class="modal hidden" id="editProfileModal">
        <div id="feedEditProfile" class="feed__edit-profile">
            <p class="modal-close-btn" id="editModalCloseBtn">x</p>
            <form class="edit-form__container" id="editProfileForm" userId=<?php echo $_SESSION['id'] ?>>
                <div class="edit-form-div__input">
                    <p class="paragraph-placeholder__text">Name</p>
                    <input class="edit-form__input" id="inputUserEditProfile" type="text" name="inputUserEditProfile" value=<?php echo $_SESSION['name']; ?> required>
                </div>
                <div class="edit-form-div__input">
                    <p class="paragraph-placeholder__text">User</p>
                    <input class="edit-form__input" id="inputNameEditProfile" type="text" name="inputNameEditProfile" value=<?php echo $_SESSION['nickname']; ?> required>
                </div>
                <div class="edit-form-div__input">
                    <p class="paragraph-placeholder__text">Gender</p>
                    <select class="edit-form__input" id="inputGenderEditProfile" type="text" name="inputGenderEditProfile" required>
                        <option <?php if ($_SESSION['gender'] === "Female") echo 'selected' ?> value="Female">Female</option>
                        <option <?php if ($_SESSION['gender'] === "Male") echo 'selected' ?> value="Male">Male</option>
                        <option <?php if ($_SESSION['gender'] === "Non binary") echo 'selected' ?> value="Non binary">Non binary</option>
                        <option <?php if ($_SESSION['gender'] === "Doesn't apply") echo 'selected' ?> value="Doesn't apply">Doesn't apply</option>
                    </select>
                </div>
                <label class="edit-profile-image-label" for="updateProfileImgInput">Edit profile image</label>
                <div id="editThumbnailContainer" class="feed__edit-thumbnail-container">
                </div>
                <input id="updateProfileImgInput" class="hidden" type="file" />
                <input type="submit" class="edit-form__button" value="Edit">
                <button class="edit-form__delete-user" id="deleteAccountBtn">Delete your account</button>
            </form>
        </div>
    </div>
    <!-- delete confirmation modal -->
    <div class="modal hidden" id="deleteConfirmationModal">
        <div class="feed__delete-confirmation-modal" id="deleteConfirmationModal">
            <h2>Are your sure?</h2>
            <div class="feed__delete-confirmation-modal-btn-group">
                <button class="feed__delete-confirmation-modal-btn feed__delete-confirmation-modal-btn-accept" id="deleteUserConfirm">Yes</button>
                <button class="feed__delete-confirmation-modal-btn feed__delete-confirmation-modal-btn-decline" id="deleteUserDecline">No</button>
            </div>
        </div>
    </div>

    <!-- add comments modal -->
    <div class="modal hidden" id="createComment">
        <div id="feedAddComments" class="feed__edit-profile">
            <form class="edit-form__container" id="insertCommentForm" userId=<?php echo $_SESSION['id'] ?>>
                <div class="edit-form-div__input">
                    <p class="paragraph-placeholder__text">Comment</p>
                    <input class="edit-form__input" id="inputCommentInsert" type="text" name="inputCommentInsert" required>
                </div>

                <input type="submit" class="edit-form__button" value="Insert Comment">
            </form>
            <p class="modal-close-btn" id="insertCommentModalCloseBtn">x</p>
        </div>
</body>

</html>