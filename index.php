<?php
session_start();
if (isset($_SESSION['id'])) {
    header("location: ./feed.php");
}
?>

<!DOCTYPE html>
<html class="html__container--background-image" lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="./assets/images/logoFavicon.png"/>
    <link rel="stylesheet" href="./assets/css/styles.css?v=<?php echo time(); ?>">
    <script src="./assets/js/logIn.js?v=<?php echo time(); ?>" defer></script>
    <title>beFriends - index</title>
</head>

<body>
    <header></header>
    <div hidden class="spinner"></div>
    <main class="main__container">
        <section class="section__container">
            <section class="section-first-body__container">
                <img class="section__img--size" src="./assets/images/logoBeFriends.png" alt="logo beFriends">
                <form id="formContainerLogIn" class="form__container">
                    <div class="form-div__input">
                        <p class="paragraph-placeholder__text">User or Email</p>
                        <input class="form__input" id="inputUserLogIn" placeholder="User or Email" type="text" name="inputUserLogIn" required>
                    </div>
                    <div class="form-div__input">
                        <p id="show1" class="paragraph-show__text">Show</p>
                        <input class="form__input input__password" id="inputPasswordLogIn" placeholder="Password" type="password" name="inputPasswordLogIn" required>
                        <p class="paragraph-placeholder__text">Password</p>
                    </div>
                    <input type="submit" class="form__button" value="Enter">
                </form>
                <div class="section-div-or__container">
                    <hr class="hr__line">
                    <p class="section__text">or</p>
                    <hr class="hr__line">
                </div>
                <div class="section-div-facebook__container">
                    <img class="facebook__icon" src="./assets/images/facebookIcon.png" alt="Facebook icon">
                    <p class="facebook__text">Log in with Facebook</p>
                    <img class="facebook__icon facebook__icon--hidden" src="./assets/images/facebookIcon.png" alt="Facebook icon">
                </div>
                <p class="paragraph-forgot__text">You forgot your password?</p>
            </section>
            <section class="section-second-body__container">
                <p class="paragraph-account__text">You don't have an account?</p>
                <p class="paragraph-register__text">Register</p>
            </section>
            <section class="section-third-body__container">
                <p class="paragraph-download__text">Download the app</p>
                <div class="div-app-icons__container">
                    <img class="icons__img" src="./assets/images/appIcon.png" alt="App store download icon">
                    <img class="icons__img" src="./assets/images/googlePlayIcon.png" alt="Google Play store download icon">
                </div>
            </section>
        </section>
    </main>
    <section class="modal-error-login__section">
    <div class="modal-error-login__div">
        <div class="modal-error-login__header">
            <p class="modal-error-login__title">Login incorrect</p>
        </div>
        <div class="modal-error-login__content">
            <div class="modal-error-login__img-container">
                <img class="modal-error-login__img" src="./assets/images/notOkIcon.png">
            </div>
            <p class="modal-error-login__paragraph">Sorry, either the user or password is not correct</p>
        </div>
    </div>
    </section>
    <section class="modal-coming-soon__section">
    <div class="modal-coming-soon__div">
        <div class="modal-coming-soon__header">
            <p class="modal-coming-soon__title">Coming soon</p>
        </div>
        <div class="modal-coming-soon__content">
            <div class="modal-coming-soon__img-container">
                <img class="modal-coming-soon__img" src="./assets/images/construction.png">
            </div>
            <p class="modal-coming-soon__paragraph">This feature is under construction</p>
        </div>
    </div>
    </section>

</body>

</html>