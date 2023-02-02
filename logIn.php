<!DOCTYPE html>
<html class="html__container--background-image" lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/styles.css">
    <script src="./script.js" defer></script>
    <title>beFriends</title>
</head>
<body>
    <header></header>
    <main>
        <section class="section__container">
            <section class="section-first-body__container">
                <img class="section__img--size" src="./assets/logoBeFriends.png" alt="logo beFriends">
                <form class="form__container">
                    <div class="form-div__input">
                        <p class="paragraph-placeholder__text">User or Email</p>
                        <input class="form__input" id="inputUserLogIn" type="text" name="inputUserLogIn">
                    </div>
                    <div class="form-div__input">
                        <p id="show1" class="paragraph-show__text">Show</p>
                        <input class="form__input input__password" id="inputPasswordLogIn" type="password" name="inputPasswordLogIn">
                        <p class="paragraph-placeholder__text">Password</p>
                    </div>
                    <button class="form__button">Enter</button>
                </form>
                <div class="section-div-or__container">
                    <hr class="hr__line">
                    <p class="section__text">or</p>
                    <hr class="hr__line">
                </div>
                <div class="section-div-facebook__container">
                    <img class="facebook__icon" src="./assets/facebookIcon.png" alt="Facebook icon">
                    <p class="facebook__text">Log in with Facebook</p>
                    <img class="facebook__icon facebook__icon--hidden" src="./assets/facebookIcon.png" alt="Facebook icon">
                </div>
                <p class="paragraph-forgot__text">You forgot your password?</p>
            </section>
            <section class="section-second-body__container">
                <p>You don't have an account</p>
                <p class="paragraph-register__text">Register</p>
            </section>
            <section class="section-third-body__container">
                <p class="paragraph-download__text" >Download the app</p>
                <div class="div-app-icons__container">
                    <img class="icons__img" src="./assets/appIcon.png" alt="App store download icon">
                    <img class="icons__img" src="./assets/googlePlayIcon.png" alt="Google Play store download icon">
                </div>
            </section>
        </section>
    </main>
    <footer></footer>
</body>
</html>