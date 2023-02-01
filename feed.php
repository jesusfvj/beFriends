<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>beFriends - feed</title>
    <link rel="stylesheet" href="./css/global.css">
    <script src="script.js" defer></script>
</head>

<body class="feed__body">
    <aside class="feed__aside">
        <div class="feed__aside-nav-container">
            <img src="./assets/logoBeFriends.png" alt="logo" class="feed__aside-logo" />
            <nav class="feed__nav">
                <div class="feed__nav-item">
                    <img src="./assets/profile.png" alt="nav-icon" class="nav__image" />
                    <p>Profile</p>
                </div>
                <div class="feed__nav-item">
                    <img src="./assets/profile.png" alt="nav-icon" class="nav__image" />
                    <p>Search</p>
                </div>
                <div class="feed__nav-item">
                    <img src="./assets/profile.png" alt="nav-icon" class="nav__image" />
                    <p>Logout</p>
                </div>
            </nav>
        </div>
    </aside>
    <main class="feed__main">
        <article class="feed__post">
            <div class="feed__article-header">
                <img class="feed__post-profile-img" src="./assets/profileImg.JPG" alt="" />
                <div>
                    <p class="feed__post-profile-name">MIQUEL_ABELLA - <span class="feed__post-profile-follow-text">follow</span></p>
                    <p class="feed__post-timestamp">1 week ago</p>
                </div>
            </div>
            <img class="feed__post-img" src="./assets/mockImage.JPG" alt="" />
            <div class="feed__article-comments-container">
                <div class="feed__post-icons-container">
                    <img class="feed__post-icon" src="./assets/heart.png" alt="" />
                    <p>5 likes</p>
                    <img class="feed__post-icon" src="./assets/message.png" alt="" />
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
        <article class="feed__post">
            <div class="feed__article-header">
                <img class="feed__post-profile-img" src="./assets/profileImg.JPG" alt="" />
                <div>
                    <p class="feed__post-profile-name">MIQUEL_ABELLA - <span class="feed__post-profile-follow-text">follow</span></p>
                    <p class="feed__post-timestamp">1 week ago</p>
                </div>
            </div>
            <img class="feed__post-img" src="./assets/mockImage.JPG" alt="" />
            <div class="feed__article-comments-container">
                <div class="feed__post-icons-container">
                    <img class="feed__post-icon" src="./assets/heart.png" alt="" />
                    <p>5 likes</p>
                    <img class="feed__post-icon" src="./assets/message.png" alt="" />
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
</body>

</html>